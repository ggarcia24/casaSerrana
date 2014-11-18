<?php
namespace Reserva\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\Mvc\Route;
 use Zend\View\Model\ViewModel;
 use Reserva\Model\Reserva;
 use Reserva\Model\ReservaTable;
 use Reserva\Model\Pabellon;
 use Reserva\Model\PabellonTable;
 use Reserva\Model\Tarifa;
 use Reserva\Model\TarifaTable;
 use Reserva\Model\Habitacion;
 use Reserva\Model\HabitacionTable;
 use Reserva\Form\HabitacionForm;
 use Reserva\Form\PabellonForm;

 use Reserva\Form\ReservaForm;

 class ReservaController extends AbstractActionController
 {
     protected $reservaTable;
     protected $habitacionTable;
     protected $pabellonTable;
     protected $categoriaTable;
     protected $estadoTable;
     protected $tarifaTable;


     public function indexAction()
     {
        $fechaHoy=date("d-m-Y");
        $fechaBusqueda=date("Y-m-d");
         return new ViewModel(array(
            'titulo'=>'Reservas al '.$fechaHoy,
            'pabellones' => $this->getPabellonTable()->fetchAll(),
            'habitaciones' => $this->getHabitacionTable()->fetchAll(),
            'reservasTodas'     => $this->getReservaTable()->fetchAll(),
            'reservas'     => $this->getReservaTable()->getReservaPorFecha($fechaBusqueda),


             
         ));
     }

     public function indexhabitacionAction()
     {
         return new ViewModel(array(
            'titulo'=>'Listado de Habitaciones',
            'pabellones' => $this->getPabellonTable()->fetchAll(),
            'habitaciones' => $this->getHabitacionTable()->fetchAll(),
            'categorias' => $this->getCategoriaTable()->fetchAll(),
         ));
     }

     public function indexpabellonAction()
     {
         return new ViewModel(array(
            'titulo'=>'Listado de Pabellones',
            'pabellones' => $this->getPabellonTable()->fetchAll(),
         ));
     }

     public function indextarifaAction()
     {
         return new ViewModel(array(
            'titulo'=>'Listado de Tarifas',
            'tarifas' => $this->getTarifaTable()->fetchAll(),
         ));
     }


     

      public function addAction()
     {
         $form = new ReservaForm();
         $form->get('send')->setValue('Agregar');
         $request = $this->getRequest();
         if ($request->isPost()) {
             $reserva = new Reserva();
             $form->setInputFilter($reserva->getInputFilter());
             $form->setData($request->getPost());


             if ($form->isValid()) {
                 $reserva->exchangeArray($form->getData());

                 
                 $this->getReservaTable()->saveReserva($reserva);


                 // Redirect to list of albums
                 return $this->redirect()->toRoute('reserva');
             }

         }
         return array('form' => $form);
     }  



    public function addhabitacionAction()
     {
        
        $form = new HabitacionForm();
        $form->get('send')->setValue('Agregar');

        $pabellones=$this->getPabellonTable()->fetchAllWithAlias();
        $vectorPabellon=array();         
        foreach ($pabellones as $pabellon) 
        {
            $vectorPabellon[]=$pabellon;
        }
        $form->get('idPabellon')->setValueOptions($vectorPabellon); 
               
        $categorias=$this->getCategoriaTable()->fetchAllWithAlias(); 
        $vectorCategoria=array();
        foreach ($categorias as $categoria) 
        {
            $vectorCategoria[]=$categoria;
        }
        $form->get('idCategoria')->setValueOptions($vectorCategoria);        
        $estados=$this->getEstadoTable()->fetchAllWithAlias(); 
        $vectorEstado=array();
        foreach ($estados as $estado) 
        {
            $vectorEstado[]=$estado;
        }
        $form->get('idEstado')->setValueOptions($vectorEstado);

        
        $request = $this->getRequest();

        if ($request->isPost()) {

             $habitacion = new Habitacion();
             $form->setInputFilter($habitacion->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {

                 $habitacion->exchangeArray($form->getData());                 
                 $this->getHabitacionTable()->saveHabitacion($habitacion);


                 // Redirect to list of albums
                 return $this->redirect()->toRoute('reserva',array('controler'=>'reserva','action'=>'indexhabitacion'));
             }

         }



        return array('form' => $form);
     }  

      public function addpabellonAction()
     {
         $form = new PabellonForm();
         $form->get('send')->setValue('Agregar');
         $request = $this->getRequest();
         if ($request->isPost()) {
             $pabellon = new Pabellon();
             $form->setInputFilter($pabellon->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) 
             {
                 
                 $pabellon->exchangeArray($form->getData());                 
                 $this->getPabellonTable()->savePabellon($pabellon);
                 return $this->redirect()->toRoute('reserva', array('controller'=>'ReservaController',
        'action' => 'indexpabellon'));
             }

         }
         return array('form' => $form);
     }  

     public function editAction()
     {
     }



    public function editpabellonAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('reserva', array(
                 'action' => 'addpabellon'
             ));
         }
         try {
             $pabellon = $this->getPabellonTable()->getPabellon($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('reserva', array(
                 'action' => 'indexpabellon'
             ));
         }
         $form  = new PabellonForm();

         $form->bind($pabellon);
         
         $form->get('send')->setAttribute('value', 'Editar');

         $request = $this->getRequest();

         
         if ($request->isPost()) {

             $form->setInputFilter($pabellon->getInputFilter());
             $form->setData($request->getPost());
             
             if ($form->isValid()) {
                
                
                 $this->getPabellonTable()->savePabellon($pabellon);
                 return $this->redirect()->toRoute('reserva', array('controller'=>'ReservaController',
        'action' => 'indexpabellon'));
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
    }

    public function edithabitacionAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('reserva', array(
                 'action' => 'addhabitacion'
             ));
         }
         try {
             $habitacion = $this->getHabitacionTable()->getHabitacion($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('reserva', array(
                 'action' => 'indexhabitacion'
             ));
         }
         $form  = new HabitacionForm();



        $pabellones=$this->getPabellonTable()->fetchAllWithAlias();
        $vectorPabellon=array();         
        foreach ($pabellones as $pabellon) 
        {
            $vectorPabellon[]=$pabellon;
        }
        $form->get('idPabellon')->setValueOptions($vectorPabellon); 
               
        $categorias=$this->getCategoriaTable()->fetchAllWithAlias(); 
        $vectorCategoria=array();
        foreach ($categorias as $categoria) 
        {
            $vectorCategoria[]=$categoria;
        }
        $form->get('idCategoria')->setValueOptions($vectorCategoria);        
        $estados=$this->getEstadoTable()->fetchAllWithAlias(); 
        $vectorEstado=array();
        foreach ($estados as $estado) 
        {
            $vectorEstado[]=$estado;
        }
        $form->get('idEstado')->setValueOptions($vectorEstado);


         $form->bind($habitacion);         
         $form->get('send')->setAttribute('value', 'Editar');
         $request = $this->getRequest();
         
         if ($request->isPost()) {

             $form->setInputFilter($habitacion->getInputFilter());
             $form->setData($request->getPost());
             
             if ($form->isValid()) {
                
                
                 $this->getHabitacionTable()->saveHabitacion($habitacion);
                 return $this->redirect()->toRoute('reserva', array('controller'=>'ReservaController',
        'action' => 'indexhabitacion'));
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
    }

     public function bookAction()
     {
        $form = new ReservaForm();
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('reserva', array(
                 'action' => 'book'
             ));
         }
         $habitacion=$this->getHabitacionTable()->getHabitacion($id);
         $pabellon=$this->getPabellonTable()->getPabellon($habitacion->idPabellon);
         return array(
                        'form' => $form,
                        'habitacion'=> $habitacion,
                        'pabellonEncontrado'=>$pabellon,
                    );
     }

     public function gridreservaAction()
     {

        $fechaDesde =  $this->params()->fromRoute('fechaDesde', 0);
        $fechaHasta =  $this->params()->fromRoute('fechaHasta', 0);
        //$pabellon = (int) $this->params()->fromRoute('pabellon', 0);

        return new ViewModel(array(
            'titulo'    => 'Grilla de Reserva',
            'fechaDesde'=>$fechaDesde,
            'fechaHasta' => $fechaHasta,
            'habitaciones' => $this->getHabitacionTable()->fetchAll(),
            'grillas' => $this->getReservaTable()->getReservaPorFechas($fechaDesde, $fechaHasta),
           // 'pabellon' => $pabellon,
        ));
     }

     public function deleteAction()
     {
        $id = (int) $this->params()->fromRoute("id", 0);
        $this->getReservaTable()->deleteReserva($id);
        return $this->redirect()->toRoute('reserva',array('controler'=>'reserva','action'=>'index'));
     }

       public function deletehabitacionAction()
     {
        $id = (int) $this->params()->fromRoute("id", 0);
        $this->getHabitacionTable()->deleteHabitacion($id);
        return $this->redirect()->toRoute('reserva',array('controler'=>'reserva','action'=>'indexhabitacion'));
     }

     public function deletepabellonAction()
     {
        $id = (int) $this->params()->fromRoute("id", 0);
        $this->getPabellonTable()->deletePabellon($id);
        return $this->redirect()->toRoute('reserva',array('controler'=>'reserva','action'=>'indexpabellon'));
     }

     public function getReservaTable()
     {
         if (!$this->reservaTable) {
             $sm = $this->getServiceLocator();
             $this->reservaTable = $sm->get('Reserva\Model\ReservaTable');
         }
         return $this->reservaTable;
     }
    public function getHabitacionTable()
    {
        if (!$this->habitacionTable) {
            $sm = $this->getServiceLocator();
            $this->habitacionTable = $sm->get('Reserva\Model\HabitacionTable');
        }
        return $this->habitacionTable;
    }
    

    public function getPabellonTable()
    {
        if (!$this->pabellonTable) {
            $sm = $this->getServiceLocator();
            $this->pabellonTable = $sm->get('Reserva\Model\PabellonTable');
        }
        return $this->pabellonTable;
    }  

        public function getCategoriaTable()
    {   

        if (!$this->categoriaTable) {
            $sm = $this->getServiceLocator();
            $this->categoriaTable = $sm->get('Reserva\Model\CategoriaTable');
        }
        return $this->categoriaTable;
    }

    public function getEstadoTable()
    {   

        if (!$this->estadoTable) {
            $sm = $this->getServiceLocator();
            $this->estadoTable = $sm->get('Reserva\Model\EstadoTable');
        }
        return $this->estadoTable;
    }

     public function getTarifaTable()
    {   

        if (!$this->tarifaTable) {
            $sm = $this->getServiceLocator();
            $this->tarifaTable = $sm->get('Reserva\Model\TarifaTable');
        }
        return $this->tarifaTable;
    }
    
 }