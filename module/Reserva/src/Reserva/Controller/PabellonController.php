<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 06:36 PM
 */

namespace Reserva\Controller;


use Reserva\Form\PabellonForm;
use Reserva\Model\Pabellon;
use Reserva\Model\PabellonTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PabellonController extends AbstractActionController
{

    protected $pabellonTable;

    public function indexAction() {
        return new ViewModel(array(
            'pabellones' => $this->getPabellonTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $form = new PabellonForm();
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $pabellon = new Pabellon();
            $form->setInputFilter($pabellon->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $pabellon->exchangeArray($form->getData());
                $this->getPabellonTable()->savePabellon($pabellon);
                return $this->redirect()->toRoute('pabellon', array('action' => 'index'));
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('pabellon', array('action' => 'add'));
        }
        try {
            $pabellon = $this->getPabellonTable()->getPabellon($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('pabellon', array('action' => 'index'));
        }
        $form = new PabellonForm();
        $form->bind($pabellon);
        $form->get('send')->setAttribute('value', 'Editar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($pabellon->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getPabellonTable()->savePabellon($pabellon);
                return $this->redirect()->toRoute('pabellon', array('action' => 'index'));
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $id = (int)$this->params()->fromRoute("id", 0);
        $this->getPabellonTable()->deletePabellon($id);
        return $this->redirect()->toRoute('pabellon', array('action' => 'index'));
    }

    /**
     * @return PabellonTable
     */
    public function getPabellonTable()
    {
        if (!$this->pabellonTable) {
            $sm = $this->getServiceLocator();
            $this->pabellonTable = $sm->get('Reserva\Model\PabellonTable');
        }
        return $this->pabellonTable;
    }

}