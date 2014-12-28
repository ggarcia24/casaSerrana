<?php
namespace Cliente\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Cliente\Model\Alimento;
 use Cliente\Model\AlimentoTable;
 use Cliente\Form\AlimentoForm;
 use Zend\ViewModel\JsonModel;

 class AlimentoController extends AbstractActionController
 {
    protected $alimentoTable;
    
    public function indexAction()
    {
        $alimentos=$this->getAlimentoTable()->fetchAll();
        return new ViewModel(array(
                                    'titulo'   => 'Listado de Alimentos',
                                    'alimentos' => $alimentos,
                                  )
                            );
    }

    public function addAction()
    {
        $form = new AlimentoForm();        
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();
        
        if ($request->isPost()) 
        {
            $alimento = new Alimento();
            $form->setInputFilter($alimento->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {            
                $alimento->exchangeArray($form->getData());                 
                $this->getAlimentoTable()->saveAlimento($alimento);
                return $this->redirect()->toRoute('alimento');
            }
        }
        return array('form' => $form);
    }  

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id)
        {
            return $this->redirect()->toRoute('alimento', array('action' => 'add'));
        }
        try 
        {
            $alimento = $this->getAlimentoTable()->getAlimento($id);
        }
        catch (\Exception $ex) 
        {
            return $this->redirect()->toRoute('alimento', array('action' => 'index'));
        }
        $form  = new AlimentoForm();
        $form->bind($alimento);
        $form->get('send')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if ($request->isPost()) 
        {
            $form->setInputFilter($alimento->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) 
            {
                $this->getAlbumTable()->saveAlimento($alimento);
                return $this->redirect()->toRoute('alimento');
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
       $this->getAlimentoTable()->deleteAlimento($id);
       return $this->redirect()->toRoute('alimento',array('controler'=>'alimento','action'=>'index'));
    }

    public function getAlimentoTable()
    {
        if (!$this->alimentoTable) 
        {
            $sm = $this->getServiceLocator();            
            $this->alimentoTable = $sm->get('Cliente\Model\AlimentoTable');
        }
        return $this->alimentoTable;
    }
 }