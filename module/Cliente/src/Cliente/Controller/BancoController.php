<?php
namespace Cliente\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Cliente\Model\Banco;
 use Cliente\Model\BancoTable;
 use Cliente\Form\BancoForm;
 use Zend\ViewModel\JsonModel;

 class BancoController extends AbstractActionController
 {
    protected $bancoTable;
    
    public function indexAction()
    {
        $bancos=$this->getBancoTable()->fetchAll();
        return new ViewModel(array(
                                    'titulo'   => 'Listado de Bancos',
                                    'bancos' => $bancos,
                                  )
                            );
    }

    public function addAction()
    {
        $form = new BancoForm();
        
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $banco = new Banco();
            $form->setInputFilter($banco->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {            
                $banco->exchangeArray($form->getData());                 
                $this->getBancoTable()->saveBanco($banco);
                return $this->redirect()->toRoute('banco');
            }
        }

        
        return array('form' => $form);
    }  

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id)
        {
            return $this->redirect()->toRoute('banco', array('action' => 'add'));
        }
        try 
        {
            $banco = $this->getBancoTable()->getBanco($id);
        }
        catch (\Exception $ex) 
        {
            return $this->redirect()->toRoute('banco', array('action' => 'index'));
        }
        $form  = new BancoForm();
        $form->bind($banco);
        $form->get('send')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if ($request->isPost()) 
        {
            $form->setInputFilter($banco->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) 
            {
                $this->getAlbumTable()->saveBanco($banco);
                return $this->redirect()->toRoute('banco');
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
       $this->getBancoTable()->deleteBanco($id);
       return $this->redirect()->toRoute('banco',array('controler'=>'banco','action'=>'index'));
    }

    public function getBancoTable()
    {
        if (!$this->bancoTable) 
        {
            $sm = $this->getServiceLocator();
            $this->bancoTable = $sm->get('Cliente\Model\BancoTable');
        }
        return $this->bancoTable;
    }

 }