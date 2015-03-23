<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 07:57 PM
 */

namespace Reserva\Controller;


use Reserva\Form\CategoriaForm;
use Reserva\Model\Categoria;
use Reserva\Model\CategoriaTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoriaController extends AbstractActionController {

    protected $categoriaTable;

    public function indexAction() {
        return new ViewModel(array(
            'categorias' => $this->getcategoriaTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $form = new CategoriaForm();
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $categoria = new Categoria();
            $form->setInputFilter($categoria->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $categoria->exchangeArray($form->getData());
                $this->getCategoriaTable()->save($categoria);
                return $this->redirect()->toRoute('categoria', array('action' => 'index'));
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('categoria', array('action' => 'add'));
        }
        try {
            $categoria = $this->getCategoriaTable()->get($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('categoria', array('action' => 'index'));
        }
        $form  = new CategoriaForm();
        $form->bind($categoria);
        $form->get('send')->setAttribute('value', 'Editar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($categoria->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getCategoriaTable()->save($categoria);
                return $this->redirect()->toRoute('categoria', array('action' => 'index'));
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute("id", 0);
        $this->getCategoriaTable()->delete($id);
        return $this->redirect()->toRoute('categoria', array('action'=>'index'));
    }

    /**
     * @return CategoriaTable
     */
    public function getCategoriaTable() {
        if (!$this->categoriaTable) {
            $sm = $this->getServiceLocator();
            $this->categoriaTable = $sm->get('Reserva\Model\CategoriaTable');
        }
        return $this->categoriaTable;
    }
}