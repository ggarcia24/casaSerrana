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


class GetTipoHuespedAlias extends AbstractPlugin implements ServiceLocatorAwareInterface
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
        return $this->serviceLocator;
    }

    public function __invoke() {
        $sm = $this->getServiceLocator()->getServiceLocator();
        $tipoHuespedTable = $sm->get('Reserva\Model\TipohuespedTable');
        $tipoHuespedes = $tipoHuespedTable->fetchAllWithAlias();
        if ($tipoHuespedes->count() > 0) {
            $results = new ResultSet();
            return $results->initialize($tipoHuespedes)->toArray();
        }
    }
}