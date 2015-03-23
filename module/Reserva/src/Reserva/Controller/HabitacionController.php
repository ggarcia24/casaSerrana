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
use Zend\View\Model\JsonModel;
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

    public function findAction() {
        $origGuestAmount = (int) $this->params()->fromRoute("guestAmount", 0);
        $minGuest = (int) $this->params()->fromRoute("minGuest", 0);
        $arrival = $this->params()->fromRoute("arrival", date('Y-m-d'));
        $departure = $this->params()->fromRoute("departure", date('Y-m-d'));
        $habitacionTable = $this->getHabitacionTable();
        $habitacionesDisponibles = $habitacionTable->findByAmount($minGuest, $arrival, $departure);
        $result = array();
        $guestAmount = $origGuestAmount;
        for($i=0; $i <= 10; $i++) {
            //
            if(!isset($result[$i])) {
                $result[$i] = array('categorias' => array(), 'habitaciones' => array());
            }

            foreach($habitacionesDisponibles as $pos => $habitacion) {
                $maxPer = (int) $habitacion['plazaMaxima'];
                $cantHab = (int) $habitacion['cantidadHabitaciones'];
                $roomsNeeded = ceil($guestAmount / $maxPer);

                // I need only one room or a subset of those
                if($guestAmount <= $maxPer || ($roomsNeeded <= $cantHab)) {
                    //extract the ids from the list that are available
                    //append solution to result list
                    $solucion = $this->__extractHabitacion($habitacionesDisponibles, $pos, $roomsNeeded);
                    $result[$i]['categorias'][] = $solucion['idCategoria'];
                    $result[$i]['habitaciones'][] = $solucion;
                    unset($habitacionesDisponibles[$pos]);
                    break;
                } else {
                    //Amount of persons fits, but I don't have the amount of hab available
                    if($roomsNeeded > $cantHab) {
                        $result[$i]['categorias'][] = $habitacion['idCategoria'];
                        $result[$i]['habitaciones'][] = $habitacion;
                        unset($habitacionesDisponibles[$pos]);
                        //I deduct the amount that I can fit in and continue with the
                        $guestAmount -= ($maxPer * $cantHab);
                    } else {
                        break;
                    }
                }
            }
            //Reset guest value
            $guestAmount = $origGuestAmount;
            $i++;
        }
        $this->validateResults($result, $guestAmount);
        $view = new ViewModel(array(
              'results' => $result,
              'fecha' => $arrival
          ));
        if ($this->getRequest()->isXmlHttpRequest()) {
            $view->setTerminal(true);
        }
        return $view;
    }

    /** extract one room from  */
    private function __extractHabitacion(&$habList, $pos, $amount = 1) {
        $result = array();
        $solution = $habList[$pos];
        //
        $idsHabitaciones = explode(',', $solution['idsHabitacion']);
        //Verify that I can remove that many
        if(count($idsHabitaciones) < $amount) {
            return false;
        }
        //Extract as many as $amount from $idsHabitaciones
        $newIds = array_slice($idsHabitaciones, 0, $amount);
        //Update the result
        $result['cantidadHabitaciones'] = count($newIds);
        $result['plazaMaxima'] = $solution['plazaMaxima'];
        $result['idsHabitacion'] = implode(',', $newIds);
        $result['idCategoria'] = $solution['idCategoria'];
        //Update the item in $habitacionesDisponibles with the remaining ids
        $remIds = array_slice($idsHabitaciones, $amount);
        if(!empty($remIds)) {
            $habList[$pos]['cantidadHabitaciones'] = count($remIds);
            $habList[$pos]['idsHabitacion'] = implode(',', $remIds);
        } else {
            //remove if there are no more rooms available
            unset($habList[$pos]);
        }
    }

    protected function validateResults(array &$results, $guestAmount) {
        foreach($results as $i => $result) {

            $total = 0;
            $ids = '';
            foreach($result['habitaciones'] as $habitaciones) {
                $ids = $habitaciones['idsHabitacion'] . ',' . $ids;
                $total += ((int) $habitaciones['cantidadHabitaciones'] * (int) $habitaciones['plazaMaxima']);
            }
            if($total < $guestAmount) {
                unset($results[$i]);
            } else {
                $results[$i]['categorias'] = implode(',', array_unique($result['categorias']));
                $results[$i]['total'] = $total;
                $results[$i]['ids'] = rtrim($ids,',');
            }
        }
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