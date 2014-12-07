<?php
namespace Proveedor\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Proveedor\Model\Proveedor;
 use Proveedor\Model\ProveedorTable;
 use Proveedor\Form\ProveedorForm;

 class ProveedorController extends AbstractActionController
 {
     protected $proveedorTable;


     public function indexAction()
     {
         
         return new ViewModel(array(
            'titulo' => 'Listado de Proveedores',
            'proveedores' => $this->getProveedorTable()->fetchAll(),

             
         ));
     }

     

      public function addAction()
     {
         $form = new ProveedorForm();
         $form->get('send')->setValue('Agregar');
         $request = $this->getRequest();

         if ($request->isPost()) {
            
             $proveedor = new Proveedor();
             $form->setInputFilter($proveedor->getInputFilter());
             $form->setData($request->getPost());


             if ($form->isValid()) {
                 $proveedor->exchangeArray($form->getData());

                 
                 $this->getProveedorTable()->saveProveedor($proveedor);


                 // Redirect to list of albums
                 return $this->redirect()->toRoute('proveedor');
             }

         }
         return array('form' => $form);
     }  

      public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('proveedor', array(
                 'action' => 'add'
             ));
         }
         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $proveedor = $this->getProveedorTable()->getProveedor($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('proveedor', array(
                 'action' => 'index'
             ));
         }
         $form  = new ProveedorForm();
         $form->bind($proveedor);
         $form->get('send')->setAttribute('value', 'Editar');
         $request = $this->getRequest();
         
         if ($request->isPost()) {

             $form->setInputFilter($proveedor->getInputFilter());
             $form->setData($request->getPost());
             
             if ($form->isValid()) {
                
                
                 $this->getProveedorTable()->saveProveedor($proveedor);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('proveedor');
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
        $this->getProveedorTable()->deleteProveedor($id);
        return $this->redirect()->toRoute('proveedor',array('controler'=>'proveedor','action'=>'index'));
     }

     public function getProveedorTable()
     {
         if (!$this->proveedorTable) {
             $sm = $this->getServiceLocator();
             $this->proveedorTable = $sm->get('Proveedor\Model\ProveedorTable');
         }
         return $this->proveedorTable;
     }
 }