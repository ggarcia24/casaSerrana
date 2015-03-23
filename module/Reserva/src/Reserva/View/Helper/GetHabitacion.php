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


class GetHabitacion extends AbstractHelper implements ServiceLocatorAwareInterface {

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
        if ($serviceLocator instanceof HabitacionTable) {
        }
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


    public function __invoke($id = 0) {
        $ret = 'Habitacion no encontrada';
        $sm = $this->getServiceLocator()->getServiceLocator();

        /* @var HabitacionTable $table */
        $table = $sm->get('Reserva\Model\HabitacionTable');
        try {
            if($id != 0) {
                $ret = $table->getHabitacion($id);
            }
        } catch (\Exception $e) {

        }
        return $ret;
    }
}