<?php
namespace Cliente\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Cliente\Model\Tarjeta;
 use Cliente\Model\TarjetaTable;
 use Cliente\Form\TarjetaForm;
 use Zend\ViewModel\JsonModel;

 class TarjetaController extends AbstractActionController
 {
    protected $tarjetaTable;
    
    public function indexAction()
    {
        $tarjetas=$this->getTarjetaTable()->fetchAll();
        return new ViewModel(array(
                                    'titulo'   => 'Listado de Tarjetas',
                                    'tarjetas' => $tarjetas,
                                  )
                            );
    }

    public function addAction()
    {
        $form = new TarjetaForm();        
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();        
        if ($request->isPost()) {
            $tarjeta = new Tarjeta();
            $form->setInputFilter($tarjeta->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {            
                $tarjeta->exchangeArray($form->getData());                 
                $this->getTarjetaTable()->saveTarjeta($tarjeta);
                return $this->redirect()->toRoute('tarjeta');
            }
        }        
        return array('form' => $form);
    }  

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id)
        {
            return $this->redirect()->toRoute('tarjeta', array('action' => 'add'));
        }
        try 
        {
            $tarjeta = $this->getTarjetaTable()->getTarjeta($id);
        }
        catch (\Exception $ex) 
        {
            return $this->redirect()->toRoute('tarjeta', array('action' => 'index'));
        }
        $form  = new TarjetaForm();
        $form->bind($tarjeta);
        $form->get('send')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if ($request->isPost()) 
        {
            $form->setInputFilter($tarjeta->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) 
            {
                $this->getAlbumTable()->saveBanco($tarjeta);
                return $this->redirect()->toRoute('tarjeta');
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
       $this->getTarjetaTable()->deleteTarjeta($id);
       return $this->redirect()->toRoute('tarjeta',array('controler'=>'tarjeta','action'=>'index'));
    }

    public function getTarjetaTable()
    {
        if (!$this->tarjetaTable) 
        {
            $sm = $this->getServiceLocator();
            $this->tarjetaTable = $sm->get('Cliente\Model\TarjetaTable');
        }
        return $this->tarjetaTable;
    }

 }