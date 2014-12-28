<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 02:02 PM
 */

namespace Reserva\View\Helper;

use Reserva\Model\Estado;
use Reserva\Model\Habitacion;
use Reserva\Model\HabitacionTable;
use Reserva\Model\PabellonTable;
use Reserva\Model\Reserva;
use Reserva\Model\ReservaTable;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;


class GetHabitacionStatus extends AbstractHelper implements ServiceLocatorAwareInterface {

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
        $cssClass = "defecto";
        switch ($estado) {
            case Habitacion::DISPONIBLE:
                $cssClass="disponible";
                break;
            case Habitacion::RESERVADA:
                $cssClass="reservada";
                break;
            case Habitacion::RESERVADA_SENIA:
                $cssClass="reservada_senia";
                break;
            case Habitacion::OCUPADA:
                $cssClass = "ocupada";
        }
        return $cssClass;
    }
}