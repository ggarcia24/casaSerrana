<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 05:11 PM
 */

namespace Reserva\Controller\Plugin;

use Zend\Db\ResultSet\ResultSet;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class GetHabitacion extends AbstractPlugin implements ServiceLocatorAwareInterface
{

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
        return $this->serviceLocator->getServiceLocator();
    }

    public function __invoke($id = 0) {
        $sm = $this->getServiceLocator();
        /* @var \Reserva\Model\HabitacionTable $habitacionTable */
        $habitacionTable = $sm->get('Reserva\Model\HabitacionTable');
        $habitacion = $habitacionTable->getHabitacion($id);
        return $habitacion;
    }
}