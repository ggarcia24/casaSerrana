<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 10/01/2015
 * Time: 05:28 PM
 */
namespace Cliente\Controller\Plugin;

use Cliente\Model\PaisTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GetPaisAlias extends AbstractPlugin implements ServiceLocatorAwareInterface {

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
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->serviceLocator->getServiceLocator();
    }

    public function __invoke() {
        $sm = $this->getServiceLocator();
        /** @var PaisTable $paisTable */
        $paisTable = $sm->get('Cliente\Model\PaisTable');
        $paises = $paisTable->fetchAllWithAlias();
        if ($paises->count() > 0) {
            $results = new ResultSet();
            return $results->initialize($paises)->toArray();
        }
    }
}