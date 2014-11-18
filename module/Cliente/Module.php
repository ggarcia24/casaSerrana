<?php
namespace Cliente;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Cliente\Model\Cliente;
use Cliente\Model\ClienteTable;
use Cliente\Model\Reserva;
use Cliente\Model\ReservaTable;
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
                                'Cliente\Model\ClienteTable' =>  function($sm) {
                                $tableGateway = $sm->get('ClienteTableGateway');
                                $table = new ClienteTable($tableGateway);
                                return $table;
                                },
                                'ClienteTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Cliente());
                                    return new TableGateway('clientes', $dbAdapter, null, $resultSetPrototype);
                                },

                                'Cliente\Model\ReservaTable' =>  function($sm) {
                                $tableGateway = $sm->get('ReservaTableGateway');
                                $table = new ReservaTable($tableGateway);
                                return $table;
                                },
                                'ReservaTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Reserva());                                 
                                    return new TableGateway('reservas', $dbAdapter, null, $resultSetPrototype);
                                },
                                ),



         );
     }
 }