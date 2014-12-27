<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 27/12/2014
 * Time: 02:02 PM
 */

namespace Reserva\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;


class GetCategoriaName extends AbstractHelper implements ServiceLocatorAwareInterface {

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
        if($id == 0) {
            throw new \InvalidArgumentException('ID parameter required');
        }
        $sm = $this->getServiceLocator()->getServiceLocator();
        /* @var CategoriaTable $table */
        $table = $sm->get('Reserva\Model\CategoriaTable');

        return $table->getCategoria($id)->nombre;

    }
}