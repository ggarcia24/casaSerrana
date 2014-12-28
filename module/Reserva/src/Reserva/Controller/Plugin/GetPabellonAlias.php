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


class GetPabellonAlias extends AbstractPlugin implements ServiceLocatorAwareInterface {

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

    public function __invoke() {
        $sm = $this->getServiceLocator();
        $categoriaTable = $sm->get('Reserva\Model\PabellonTable');
        $categorias = $categoriaTable->fetchAllWithAlias();
        if ($categorias->count() > 0) {
            $results = new ResultSet();
            return $results->initialize($categorias)->toArray();
        }
    }
}