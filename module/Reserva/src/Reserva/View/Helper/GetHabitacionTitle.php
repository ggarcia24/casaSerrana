<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 02:02 PM
 */

namespace Reserva\View\Helper;

use Reserva\Model\Habitacion;
use Reserva\Model\HabitacionTable;
use Reserva\Model\PabellonTable;
use Reserva\Model\Reserva;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;


class GetHabitacionTitle extends AbstractHelper implements ServiceLocatorAwareInterface {

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
        if ($serviceLocator instanceof HabitacionTable) {
        }
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
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
        $title = '';
        switch ($estado) {
            case Habitacion::DISPONIBLE:
                $title = "Disponible";
                break;
            case Habitacion::RESERVADA:
            case Habitacion::RESERVADA_SENIA:
            case Habitacion::OCUPADA:
                $title = "Reservada desde " . date_format(new \DateTime($reserva->getFechaIn()), 'd-m-Y') . " hasta " . date_format(new \DateTime($reserva->getFechaOut()), 'd-m-Y');
        }
        return $title;
    }
}