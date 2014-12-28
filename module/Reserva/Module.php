<?php
namespace Reserva;

use Reserva\Form\HabitacionFieldset;
use Reserva\Form\PabellonFieldset;
use Reserva\Form\ReservaFieldset;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ViewHelperProviderInterface,
    FormElementProviderInterface,
    ControllerPluginProviderInterface
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
                    $table = new ReservaTable(
                        $tableGateway,
                        $sm->get('Cliente\Model\ClienteTable'),
                        $sm->get('Reserva\Model\HabitacionTable'),
                        $sm->get('Reserva\Model\TarifaTable'),
                        $sm->get('Reserva\Model\EstadoTable'),
                        $sm->get('Reserva\Model\TipohuespedTable')
                    );
                    return $table;
                },
                'ReservaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Reserva());
                    return new TableGateway('reservas', $dbAdapter, null, $resultSetPrototype);
                },
                'Reserva\Model\HabitacionTable' =>  function($sm) {
                    $tableGateway = $sm->get('HabitacionTableGateway');
                    $table = new HabitacionTable(
                        $tableGateway,
                        $sm->get('Reserva\Model\PabellonTable'),
                        $sm->get('Reserva\Model\CategoriaTable'),
                        $sm->get('Reserva\Model\EstadoTable')
                    );
                    return $table;
                },
                'HabitacionTableGateway' => function ($sm) {
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
                'PabellonTableGateway' => function ($sm) {
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
                'CategoriaTableGateway' => function ($sm) {
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
                'EstadoTableGateway' => function ($sm) {
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
                'TarifaTableGateway' => function ($sm) {
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
                'TipohuespedTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Tipohuesped());
                    return new TableGateway('tipoHuespedes', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerPluginConfig()
    {
        return array(
            'factories' => array(
                'getCategoryAlias' => function($sm) {
                    $plugin = new Controller\Plugin\GetCategoryAlias();
                    $plugin->setServiceLocator($sm);
                    return $plugin;
                },
                'getEstadoAlias' => function($sm) {
                    $plugin = new Controller\Plugin\GetEstadoAlias();
                    $plugin->setServiceLocator($sm);
                    return $plugin;
                },
                'getPabellonAlias' => function($sm) {
                    $plugin = new Controller\Plugin\GetPabellonAlias();
                    $plugin->setServiceLocator($sm);
                    return $plugin;
                },
                'getTipoHuespedAlias' => function($sm) {
                    $plugin = new Controller\Plugin\GetTipoHuespedAlias();
                    $plugin->setServiceLocator($sm);
                    return $plugin;
                },
                'getHabitacion' => function($sm) {
                    $plugin = new Controller\Plugin\GetHabitacion();
                    $plugin->setServiceLocator($sm);
                    return $plugin;
                },
                'getPabellon' => function($sm) {
                    $plugin = new Controller\Plugin\GetPabellon();
                    $plugin->setServiceLocator($sm);
                    return $plugin;
                }
            )
        );
    }


    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'getHabitaciones' => function($sm) {
                    $helper = new View\Helper\GetHabitaciones();
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                },
                'getHabitacionStatus' => function($sm) {
                    $helper = new View\Helper\GetHabitacionStatus();
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                },
                'getHabitacionTitle' => function($sm) {
                    $helper = new View\Helper\GetHabitacionTitle();
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                },
                'getHabitacionHref' => function($sm) {
                    $helper = new View\Helper\GetHabitacionHref();
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                },
                'getReserva' => function($sm) {
                    $helper = new View\Helper\GetReservas();
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                },
                'getCategoriaName' => function($sm) {
                    $helper = new View\Helper\GetCategoriaName();
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                },
                'getTipoHuespedName' => function($sm) {
                    $helper = new View\Helper\GetTipoHuespedName() ;
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                },
                'getPabellones' => function($sm) {
                    $helper = new View\Helper\GetPabellones() ;
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                },
                'getPabellonName' => function($sm) {
                    $helper = new View\Helper\GetPabellonName() ;
                    $helper->setServiceLocator($sm->getServiceLocator());
                    return $helper;
                }
            )
        );
    }

    public function getFormElementConfig() {
        return array(
            'factories' => array(
                'ReservaFieldset' => function($sm) {
                    return new ReservaFieldset($sm->getServiceLocator());
                },
                'HabitacionFieldset' => function($sm) {
                    $serviceLocator = $sm->getServiceLocator();
                    $table = $serviceLocator->get('Reserva\Model\HabitacionTable');
                    return new HabitacionFieldset($table);
                },
                'PabellonFieldset' => function($sm) {
                    $serviceLocator = $sm->getServiceLocator();
                    $table = $serviceLocator->get('Reserva\Model\PabellonTable');
                    return new PabellonFieldset($table);
                },
            )
        );
    }
}