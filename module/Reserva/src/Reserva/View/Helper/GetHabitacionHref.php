<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 02:02 PM
 */

namespace Reserva\View\Helper;

use Reserva\Model\Habitacion;
use Reserva\Model\Reserva;
use Reserva\Model\ReservaTable;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;


class GetHabitacionHref extends AbstractHelper implements ServiceLocatorAwareInterface {

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function __invoke(Habitacion $habitacion, $fecha) {
        $sm = $this->getServiceLocator()->getServiceLocator();
        /* @var ReservaTable $table */
        $table = $sm->get('Reserva\Model\ReservaTable');
        /* @var Reserva $reserva */
        $reserva = $table->findByHabitacionYFecha($habitacion->getId(), $fecha);
        $estado = $reserva instanceof Reserva ? $reserva->getEstado()->getId() : Habitacion::DISPONIBLE;
        $url = $this->getView()->plugin('url');;
        switch($estado) {
            case Habitacion::RESERVADA:
            case Habitacion::RESERVADA_SENIA:
            case Habitacion::OCUPADA:
                $ret = $url('reserva', array('action' => 'view', 'id' => $reserva->getId()));
                break;
            case Habitacion::DISPONIBLE:
            default:
                $ret = $url('reserva', array('action' => 'add', 'fechaIn' => $fecha, 'idHabitacion' => $habitacion->getId()));
        }
        return $ret;
    }
}