<?php
namespace Proveedor;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Proveedor\Model\Proveedor;
use Proveedor\Model\ProveedorTable;
use Zend\Db\TableGateway\TableGateway;

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }

    public function getServiceConfig() 
    {
        return array(
            'factories' => array(
                                'Usuario\Model\Login' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    return new \Usuario\Model\Login($dbAdapter); 
                                }
                                ), 
                    );               
    }

    public function getControllerConfig() 
    {
        return array(
                    'factories' => array(
                                        'Usuario\Controller\Login' => function ($sm) 
                                        {
                                            $controller = new \Usuario\Controller\LoginController();
                                            $locator = $sm->getServiceLocator();
                                            $controller->setLogin($locator->get('Usuario\Model\Login'));
                                            return $controller;
                                        },
                                        ) 
                    );
    }
 }