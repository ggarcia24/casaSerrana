<?php
namespace Reserva;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Reserva\Model\Reserva;
use Reserva\Model\ReservaTable;
use Reserva\Model\Habitacion;
use Reserva\Model\HabitacionTable;
use Reserva\Model\Pabellon;
use Reserva\Model\PabellonTable;
use Reserva\Model\Categoria;
use Reserva\Model\CategoriaTable;
use Reserva\Model\Estado;
use Reserva\Model\EstadoTable;
use Reserva\Model\Tarifa;
use Reserva\Model\TarifaTable;
use Reserva\Model\Tipohuesped;
use Reserva\Model\TipohuespedTable;
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
                                'Reserva\Model\ReservaTable' =>  function($sm) {
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

                                'Reserva\Model\HabitacionTable' =>  function($sm) {
                                $tableGateway = $sm->get('HabitacionTableGateway');
                                $table = new HabitacionTable($tableGateway);
                                return $table;
                                },
                                'HabitacionTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Habitacion());
                                    return new TableGateway('habitaciones', $dbAdapter, null, $resultSetPrototype);
                                },
                                

                                'Reserva\Model\PabellonTable' =>  function($sm) {
                                $tableGateway = $sm->get('PabellonTableGateway');
                                $table = new PabellonTable($tableGateway);
                                return $table;
                                },
                                'PabellonTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Pabellon());
                                    return new TableGateway('pabellones', $dbAdapter, null, $resultSetPrototype);
                                },

                                'Reserva\Model\CategoriaTable' =>  function($sm) {
                                $tableGateway = $sm->get('CategoriaTableGateway');
                                $table = new CategoriaTable($tableGateway);
                                return $table;
                                },
                                'CategoriaTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Categoria());
                                    return new TableGateway('categoriaHabitaciones', $dbAdapter, null, $resultSetPrototype);
                                },
                                
                                'Reserva\Model\EstadoTable' =>  function($sm) {
                                $tableGateway = $sm->get('EstadoTableGateway');
                                $table = new EstadoTable($tableGateway);
                                return $table;
                                },
                                'EstadoTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Estado());
                                    return new TableGateway('estados', $dbAdapter, null, $resultSetPrototype);
                                },   

                                'Reserva\Model\TarifaTable' =>  function($sm) {
                                $tableGateway = $sm->get('TarifaTableGateway');
                                $table = new TarifaTable($tableGateway);
                                return $table;
                                },
                                'TarifaTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Tarifa());
                                    return new TableGateway('tarifas', $dbAdapter, null, $resultSetPrototype);
                                },


                                'Reserva\Model\TipohuespedTable' =>  function($sm) {
                                $tableGateway = $sm->get('TipohuespedTableGateway');
                                $table = new TipohuespedTable($tableGateway);
                                return $table;
                                },
                                'TipohuespedTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Tipohuesped());
                                    return new TableGateway('tipoHuespedes', $dbAdapter, null, $resultSetPrototype);
                                },                                        
                                

                                
                                ),



         );
     }
 }