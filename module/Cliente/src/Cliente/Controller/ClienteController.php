<?php
namespace Cliente\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Cliente\Model\Cliente;
 use Cliente\Model\ClienteTable;
 use Cliente\Model\PaisTable;
 use Cliente\Model\ProvinciaTable;
 use Cliente\Model\ConvenioTable;
 use Cliente\Form\ClienteForm;
 use Zend\ViewModel\JsonModel;

 class ClienteController extends AbstractActionController
 {
     protected $clienteTable;
     protected $paisTable;
     protected $reservaTable;
     protected $provinciaTable;
     protected $tarjetaTable;
     protected $alimentoTable;
     protected $convenioTable;

     public function indexAction()
     {
        $clientes=$this->getClienteTable()->fetchAll();
        //$term= $this->getRequest()->getQuery('term', '');
        //$clientesBuscados=$this->getClienteTable()->getClientePorDatos($term);
        
        
        
        if (!$this->getRequest()->isXmlHttpRequest()) 
        {
            return new ViewModel(array(
                                       'titulo'   => 'Listado de Clientes',
                                       'clientes' => $clientes,
                                       )
                                );    
        }else
        {
        
            $term= $this->getRequest()->getQuery('term', '');
            $clientesBuscados=$this->getClienteTable()->getClientePorDatos($term);            
            $res = array();
            foreach($clientesBuscados as $clienteBuscado)
            {
                $res[] = array(                    
                    'label' => $clienteBuscado["nombre"] . ' ' . $clienteBuscado["apellido"],
                    'nombre' =>  $clienteBuscado["nombre"],
                    'cliente' =>  $clienteBuscado["idCliente"],
                    'email' => $clienteBuscado["email"], 
                    'telefono' => $clienteBuscado["telefono"],
                    'idPadronAfiliado' => $clienteBuscado["idPadronAfiliado"],
                    'value' => json_encode($clientesBuscados)
                );
            }                
            $result = new \Zend\View\Model\JsonModel($res);
            return $result;
        }
     }

     public function addAction()
     {
         $form = new ClienteForm();
         
        //paises//
        $paises=$this->getPaisTable()->fetchAllWithAlias();
        $vectorPais=array();         
        foreach ($paises as $pais) 
        {
            $vectorPais[]=$pais;
        }
        $form->get('pais')->setValueOptions($vectorPais); 
        //fin paises//
        //provincias//
        $provincias=$this->getProvinciaTable()->fetchAllWithAlias();
        $vectorProvincia=array();         
        foreach ($provincias as $provincia) 
        {
            $vectorProvincia[]=$provincia;
        }
        $form->get('provincia')->setValueOptions($vectorProvincia); 
        //fin provincias//
        //tarjetas 
        $tarjetas=$this->getTarjetaTable()->fetchAllWithAlias();
        $vectorTarjeta=array();         
        foreach ($tarjetas as $tarjeta) 
        {
            $vectorTarjeta[]=$tarjeta;
        }
        $form->get('tarjeta')->setValueOptions($vectorTarjeta);         
        //fin tarjetas
        //alimentos
        $alimentos=$this->getAlimentoTable()->fetchAllWithAlias();
        $vectorAlimento=array();         
        foreach ($alimentos as $alimento) 
        {
            $vectorAlimento[]=$alimento;
        }
        $form->get('alimento')->setValueOptions($vectorAlimento);         
        //fin alimentos
        //bancos
        $bancos=$this->getBancoTable()->fetchAllWithAlias();
        $vectorBanco=array();         
        foreach ($bancos as $banco) 
        {
            $vectorBanco[]=$banco;
        }
        $form->get('banco')->setValueOptions($vectorBanco);         
        //fin bancos

        //convenios
        
        $convenios=$this->getConvenioTable()->fetchAllWithAlias();
        $vectorConvenio=array();
        foreach ($convenios as $convenio) 
        {
            $vectorConvenio[]=$convenio;
        }
        $form->get('idPadronAfiliado')->setValueOptions($vectorConvenio);         
        //fin convenios



        
         $form->get('send')->setValue('Agregar');
         $request = $this->getRequest();
         if ($request->isPost()) {
             //print_r($request);
             //exit;  
             $cliente = new Cliente();
             $form->setInputFilter($cliente->getInputFilter());
             $form->setData($request->getPost());
             if ($form->isValid()) {            
                 $cliente->exchangeArray($form->getData());                 
                 $this->getClienteTable()->saveCliente($cliente);
                 
                 //viendo tarjetas
                 $tarjetaPorCliente= new TarjetaPorCliente();
                 $tarjetaPorCliente->exchangeArray($form->getData());
                 $i=1;
                 while($i <= 10)
                 {
                     $this->getTarjetaTable()->saveTarjeta($tarjetaPorCliente);
                     $i++;
                     
                 }
                 
                 


                 // Redirect to list of albums
                 return $this->redirect()->toRoute('cliente');
             }

         }
         return array('form' => $form);
     }  

      public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('cliente', array(
                 'action' => 'add'
             ));
         }
         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $cliente = $this->getClienteTable()->getCliente($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('cliente', array(
                 'action' => 'index'
             ));
         }
         $form  = new ClienteForm();
        //paises//
        $paises=$this->getPaisTable()->fetchAllWithAlias();
        $vectorPais=array();         
        foreach ($paises as $pais) 
        {
            $vectorPais[]=$pais;
        }
        $form->get('pais')->setValueOptions($vectorPais); 
        //fin paises//
        //provincias//
        $provincias=$this->getProvinciaTable()->fetchAllWithAlias();
        $vectorProvincia=array();         
        foreach ($provincias as $provincia) 
        {
            $vectorProvincia[]=$provincia;
        }
        $form->get('provincia')->setValueOptions($vectorProvincia); 
        //fin provincias//
         $form->bind($cliente);
         $form->get('send')->setAttribute('value', 'Edit');
         $request = $this->getRequest();
         
         if ($request->isPost()) {

             $form->setInputFilter($cliente->getInputFilter());
             $form->setData($request->getPost());
             
             if ($form->isValid()) {
                
                
                 $this->getAlbumTable()->saveCliente($cliente);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('cliente');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
    }

     public function deleteAction()
     {
        $id = (int) $this->params()->fromRoute("id", 0);
        $this->getClienteTable()->deleteCliente($id);
        return $this->redirect()->toRoute('cliente',array('controler'=>'cliente','action'=>'index'));
     }

     public function getClienteTable()
     {
         if (!$this->clienteTable) {
             $sm = $this->getServiceLocator();
             $this->clienteTable = $sm->get('Cliente\Model\ClienteTable');
         }
         return $this->clienteTable;
     }

     public function getPaisTable()
     {
         if (!$this->paisTable) {
             $sm = $this->getServiceLocator();
             $this->paisTable = $sm->get('Cliente\Model\PaisTable');
         }
         return $this->paisTable;
     }
     
     public function getProvinciaTable()
     {
         if (!$this->provinciaTable) {
             $sm = $this->getServiceLocator();
             $this->provinciaTable = $sm->get('Cliente\Model\ProvinciaTable');
         }
         return $this->provinciaTable;
     }     

     public function getTarjetaTable()
     {
         if (!$this->tarjetaTable) {
             $sm = $this->getServiceLocator();
             $this->tarjetaTable = $sm->get('Cliente\Model\TarjetaTable');
         }
         return $this->tarjetaTable;
     }
     
     public function getAlimentoTable()
     {
         if (!$this->alimentoTable) {
             $sm = $this->getServiceLocator();
             $this->alimentoTable = $sm->get('Cliente\Model\AlimentoTable');
         }
         return $this->alimentoTable;
     }  

    public function getConvenioTable()
    {   

        if (!$this->convenioTable) {
            $sm = $this->getServiceLocator();
            $this->convenioTable = $sm->get('Cliente\Model\ConvenioTable');
        }
        return $this->convenioTable;
    }
 }