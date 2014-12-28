<?php
namespace Reserva\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Route;
use Zend\View\Model\ViewModel;
use Reserva\Model\Reserva;
use Reserva\Form\ReservaForm;

class ReservaController extends AbstractActionController {

    protected $reservaTable;

    public function setResources() {
        $this->getViewHelper('HeadLink')->appendStylesheet('/css/reserva.css');
        $this->getViewHelper('HeadScript')->appendFile('/js/reserva.js');
    }

    public function indexAction() {
        $this->setResources();
        $fecha=date("d-m-Y");
        return new ViewModel(array(
            'fecha'=> $fecha,
        ));
    }

    public function viewAction() {
        $this->setResources();

    }

    public function addAction() {
        $this->setResources();

        $reserva = new Reserva();
        /* @var \Reserva\Model\ReservaTable $reservaTable */
        $reservaTable = $this->getReservaTable();
        $formManager = $this->serviceLocator->get('FormElementManager');
        /* @var ReservaForm $form */
        $form = $formManager->get('Reserva\Form\ReservaForm');

        $formData = array();

        $autocomplete = $form->get('reserva')->get('cliente')->get('nombre');
        $autocompleteParams = $autocomplete->getAttribute('jquery');
        $autocompleteParams['source'] = $this->url()->fromRoute('cliente');
        $autocomplete->setAttribute('jquery', $autocompleteParams);

        $idReserva = (int) $this->params()->fromRoute('id', 0);
        $idHabitacion = (int) $this->params()->fromRoute('idHabitacion', 0);
        $fechaIn = date('Y-m-d', strtotime($this->params()->fromRoute('fechaIn', date('Y-m-d'))));

        if($idReserva != 0) {
            $reserva = $reservaTable->getReserva($idReserva);
        } elseif($idHabitacion != 0) {
            $reserva->setHabitacion($this->getHabitacion($idHabitacion));
            $reserva->setFechaIn($fechaIn);
        }
        $form->bind($reserva);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getReservaTable()->saveReserva($reserva);
                return $this->redirect()->toRoute('reserva');
            }
        }

        return array(
            'form' => $form,
        );
    }

     public function gridreservaAction() {
         $this->setResources();

        $fechaDesde = $this->params()->fromRoute('fechaDesde', 0);
        $fechaHasta = $this->params()->fromRoute('fechaHasta', 0);
        //$pabellon = (int) $this->params()->fromRoute('pabellon', 0);

        return new ViewModel(array(
            'titulo'    => 'Grilla de Reserva',
            'fechaDesde'=>$fechaDesde,
            'fechaHasta' => $fechaHasta,
            'grillas' => $this->getReservaTable()->getReservaPorFechas($fechaDesde, $fechaHasta),
        ));
     }

    public function getReservaTable() {
        if (!$this->reservaTable) {
            $sm = $this->getServiceLocator();
            $this->reservaTable = $sm->get('Reserva\Model\ReservaTable');
        }
        return $this->reservaTable;
    }

    protected function getViewHelper($helperName) {
        return $this->getServiceLocator()->get('viewhelpermanager')->get($helperName);
    }
 }