<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 07:57 PM
 */

namespace Reserva\Controller;


use Reserva\Form\TipohuespedForm;
use Reserva\Model\Tipohuesped;
use Reserva\Model\TipohuespedTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TipoConvenioController extends AbstractActionController {

    protected $tipohuespedTable;

    public function indexAction() {
        return new ViewModel(array(
            'tipohuespedes' => $this->getTipohuespedTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $form = new TipohuespedForm();
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $tipohuesped = new Tipohuesped();
            $form->setInputFilter($tipohuesped->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $tipohuesped->exchangeArray($form->getData());
                $this->getTipohuespedTable()->saveTipohuesped($tipohuesped);
                return $this->redirect()->toRoute('tipo-convenio', array('action' => 'index'));
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('tipo-convenio', array('action' => 'add'));
        }
        try {
            $tipohuesped = $this->getTipohuespedTable()->getTipohuesped($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('tipo-convenio', array('action' => 'index'));
        }
        $form  = new TipohuespedForm();
        $form->bind($tipohuesped);
        $form->get('send')->setAttribute('value', 'Editar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($tipohuesped->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getTipohuespedTable()->saveTipohuesped($tipohuesped);
                return $this->redirect()->toRoute('tipo-convenio', array('action' => 'index'));
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute("id", 0);
        $this->getTipohuespedTable()->deleteTipohuesped($id);
        return $this->redirect()->toRoute('tipo-convenio',array('action'=>'index'));
    }

    /**
     * @return TipohuespedTable
     */
    public function getTipohuespedTable() {
        if (!$this->tipohuespedTable) {
            $sm = $this->getServiceLocator();
            $this->tipohuespedTable = $sm->get('Reserva\Model\TipohuespedTable');
        }
        return $this->tipohuespedTable;
    }
}