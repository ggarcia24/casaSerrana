<?php
namespace Cliente\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Cliente\Model\Cliente;
 use Cliente\Model\ClienteTable;
 use Cliente\Form\ClienteForm;

 class ClienteController extends AbstractActionController
 {
     protected $clienteTable;
     protected $reservaTable;

     public function indexAction()
     {
                 
         return new ViewModel(array(
            'titulo' => 'Listado de Clientes',
            'clientes' => $this->getClienteTable()->fetchAll(),
            //'clientesPorFecha' => $this->getClienteTable()->getClientePorFecha(),
            //'reservas' => $this->getReservaTable()->fetchAll(),
             
         ));
     }

     

      public function addAction()
     {
         $form = new ClienteForm();
         $form->get('send')->setValue('Agregar');
         $request = $this->getRequest();
         if ($request->isPost()) {
             $cliente = new Cliente();
             $form->setInputFilter($cliente->getInputFilter());
             $form->setData($request->getPost());
             if ($form->isValid()) {            
                 $cliente->exchangeArray($form->getData());                 
                 $this->getClienteTable()->saveCliente($cliente);


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

     public function getReservaTable()
     {
         if (!$this->reservaTable) {
             $sm = $this->getServiceLocator();
             $this->reservaTable = $sm->get('Cliente\Model\ReservaTable');
         }
         return $this->reservaTable;
     }
 }