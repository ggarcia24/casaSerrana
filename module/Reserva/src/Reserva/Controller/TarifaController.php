<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 04:21 PM
 */

namespace Reserva\Controller;

use Reserva\Form\TarifaForm;
use Reserva\Model\Tarifa;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;;


class TarifaController extends AbstractActionController {

    protected $tarifaTable;

    public function indexAction() {
        return new ViewModel(array(
            'tarifas' => $this->getTarifaTable()->fetchAll()
        ));
    }

    public function addAction() {
        $form = new TarifaForm($this->getServiceLocator());
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $tarifa = new Tarifa();
            $form->setInputFilter($tarifa->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $tarifa->exchangeArray($form->getData());
                $this->getTarifaTable()->saveTarifa($tarifa);
                return $this->redirect()->toRoute('tarifa', array('action' => 'index'));
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('tarifa', array('action' => 'add'));
        }

        try {
            $tarifa = $this->getTarifaTable()->getTarifa($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('tarifa', array('action' => 'index'));
        }

        $form  = new TarifaForm($this->getServiceLocator());
        $form->bind($tarifa);
        $form->get('send')->setAttribute('value', 'Editar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($tarifa->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getTarifaTable()->saveTarifa($tarifa);
                return $this->redirect()->toRoute('tarifa', array('action' => 'index'));
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute("id", 0);
        $this->getTarifaTable()->deleteTarifa($id);
        return $this->redirect()->toRoute('tarifa',array('action'=>'index'));
    }

    /**
     * @return TarifaTable
     */
    public function getTarifaTable() {
        if (!$this->tarifaTable) {
            $sm = $this->getServiceLocator();
            $this->tarifaTable = $sm->get('Reserva\Model\TarifaTable');
        }
        return $this->tarifaTable;
    }
}