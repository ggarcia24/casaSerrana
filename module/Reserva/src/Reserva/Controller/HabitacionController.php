<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 05:51 PM
 */

namespace Reserva\Controller;

use Reserva\Form\HabitacionForm;
use Reserva\Model\Habitacion;
use Reserva\Model\HabitacionTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HabitacionController extends AbstractActionController {

    protected $habitacionTable;

    public function indexAction() {
        return new ViewModel(array(
            'habitaciones' => $this->getHabitacionTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $habitacion = new Habitacion();
        $form = new HabitacionForm($this->getServiceLocator());
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($habitacion->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $habitacion->exchangeArray($form->getData());
                $this->getHabitacionTable()->saveHabitacion($habitacion);
                // Redirect to list of albums
                return $this->redirect()->toRoute('habitacion',array('action'=>'index'));
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('habitacion', array('action' => 'add'));
        }
        try {
            $habitacion = $this->getHabitacionTable()->getHabitacion($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('habitacion', array('action' => 'index'));
        }
        $form  = new HabitacionForm($this->getServiceLocator());
        $form->bind($habitacion);
        $form->get('send')->setAttribute('value', 'Editar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($habitacion->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getHabitacionTable()->saveHabitacion($habitacion);
                return $this->redirect()->toRoute('habitacion', array('action' => 'index'));
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute("id", 0);
        $this->getHabitacionTable()->deleteHabitacion($id);
        return $this->redirect()->toRoute('habitacion',array('action'=>'index'));
    }

    /**
     * @return HabitacionTable
     */
    public function getHabitacionTable() {
        if (!$this->habitacionTable) {
            $sm = $this->getServiceLocator();
            $this->habitacionTable = $sm->get('Reserva\Model\HabitacionTable');
        }
        return $this->habitacionTable;
    }

}