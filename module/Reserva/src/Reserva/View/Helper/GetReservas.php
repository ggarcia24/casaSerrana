<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 02:02 PM
 */

namespace Reserva\View\Helper;

use Reserva\Model\HabitacionTable;
use Reserva\Model\PabellonTable;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;


class GetReservas extends AbstractHelper implements ServiceLocatorAwareInterface {

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
}

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator->getServiceLocator();
    }


    public function __invoke($idHabitacion, $fecha) {
        $sm = $this->getServiceLocator();
        /* @var \Reserva\Model\ReservaTable $reservaTable */
        $reservaTable = $sm->get('Reserva\Model\ReservaTable');
        return $reservaTable->findByHabitacionYFecha($idHabitacion, $fecha);
    }
}