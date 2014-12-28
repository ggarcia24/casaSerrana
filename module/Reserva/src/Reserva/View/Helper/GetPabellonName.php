<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 02:02 PM
 */

namespace Reserva\View\Helper;

use Reserva\Model\PabellonTable;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;


class GetPabellonName extends AbstractHelper implements ServiceLocatorAwareInterface {

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


    public function __invoke($id = 0)
    {
        $ret = 'Pabellon no encontrado';
        $sm = $this->getServiceLocator();
        /* @var PabellonTable $table */
        $table = $sm->get('Reserva\Model\PabellonTable');
        try {
            $ret = $table->getPabellon($id)->getNombre();
        } catch (\Exception $e) {

        }
        return $ret;
    }
}