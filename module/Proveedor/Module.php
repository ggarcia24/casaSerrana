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
                                'Proveedor\Model\ProveedorTable' =>  function($sm) {
                                $tableGateway = $sm->get('ProveedorTableGateway');
                                $table = new ProveedorTable($tableGateway);
                                return $table;
                                },
                                'ProveedorTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Proveedor());
                                    return new TableGateway('proveedores', $dbAdapter, null, $resultSetPrototype);
                                },

                                
                                ),



         );
     }
 }