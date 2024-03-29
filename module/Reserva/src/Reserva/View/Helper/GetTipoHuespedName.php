<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 02:02 PM
 */

namespace Reserva\View\Helper;

use Reserva\Model\TipohuespedTable;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;

class GetTipoHuespedName extends AbstractHelper implements ServiceLocatorAwareInterface {

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
        $ret = 'Tipo de Huesped no encontrado';
        $sm = $this->getServiceLocator()->getServiceLocator();
        /* @var TipohuespedTable $table */
        $table = $sm->get('Reserva\Model\TipohuespedTable');
        try {
            $ret = $table->getTipohuesped($id)->nombre;
        } catch (\Exception $e) {

        }
        return $ret;

    }
}