<?php

namespace Reserva\View\Helper;

use Reserva\Model\HabitacionTable;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;


class GetHabitacionName extends AbstractHelper implements ServiceLocatorAwareInterface {

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
        return $this->serviceLocator;
    }


    public function __invoke($id = 0)
    {
        $ret = 'Habitacion no encontrado';
        $sm = $this->getServiceLocator()->getServiceLocator();
        /* @var PabellonTable $table */
        $table = $sm->get('Reserva\Model\HabitacionTable');
        try {
            $ret = $table->getHabitacion($id)->numero;
        } catch (\Exception $e) {

        }
        return $ret;
    }
}