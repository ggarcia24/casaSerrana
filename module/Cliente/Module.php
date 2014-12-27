<?php
namespace Cliente;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Cliente\Model\Cliente;
use Cliente\Model\ClienteTable;
use Cliente\Model\Alimento;
use Cliente\Model\AlimentoTable;
use Cliente\Model\Banco;
use Cliente\Model\BancoTable;
use Cliente\Model\Tarjeta;
use Cliente\Model\TarjetaTable;
use Cliente\Model\ProvinciaTable;
use Cliente\Model\PaisTable;
use Cliente\Model\Convenio;
use Cliente\Model\ConvenioTable;

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
                                'Cliente\Model\ClienteTable' =>  function($sm) 
                                {
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

                                'Cliente\Model\BancoTable' =>  function($sm) {
                                $tableGateway = $sm->get('BancoTableGateway');
                                $table = new BancoTable($tableGateway);
                                return $table;
                                },
                                'BancoTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Banco());                                 
                                    return new TableGateway('bancos', $dbAdapter, null, $resultSetPrototype);
                                },
                                       
                                'Cliente\Model\AlimentoTable' =>  function($sm) {
                                $tableGateway = $sm->get('AlimentoTableGateway');
                                $table = new AlimentoTable($tableGateway);
                                return $table;
                                },
                                'AlimentoTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Alimento());
                                    return new TableGateway('alimentos', $dbAdapter, null, $resultSetPrototype);
                                },                                        
         
                                'Cliente\Model\TarjetaTable' =>  function($sm) {
                                $tableGateway = $sm->get('TarjetaTableGateway');
                                $table = new TarjetaTable($tableGateway);
                                return $table;
                                },
                                'TarjetaTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    $resultSetPrototype->setArrayObjectPrototype(new Tarjeta());
                                    return new TableGateway('tarjetas', $dbAdapter, null, $resultSetPrototype);
                                },          
                                        
                                'Cliente\Model\PaisTable' =>  function($sm) {
                                $tableGateway = $sm->get('PaisTableGateway');
                                $table = new PaisTable($tableGateway);
                                return $table;
                                },
                                'PaisTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    //$resultSetPrototype->setArrayObjectPrototype(new Pais());
                                    return new TableGateway('paises', $dbAdapter, null, $resultSetPrototype);
                                },                                         

                                'Cliente\Model\ProvinciaTable' =>  function($sm) {
                                $tableGateway = $sm->get('ProvinciaTableGateway');
                                $table = new ProvinciaTable($tableGateway);
                                return $table;
                                },
                                'ProvinciaTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    //$resultSetPrototype->setArrayObjectPrototype(new Pais());
                                    return new TableGateway('provincias', $dbAdapter, null, $resultSetPrototype);
                                },

                                'Cliente\Model\ConvenioTable' =>  function($sm) {
                                $tableGateway = $sm->get('ConvenioTableGateway');
                                $table = new ConvenioTable($tableGateway);
                                return $table;
                                },
                                'ConvenioTableGateway' => function ($sm) 
                                {
                                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                    $resultSetPrototype = new ResultSet();
                                    //$resultSetPrototype->setArrayObjectPrototype(new Pais());
                                    return new TableGateway('tipoHuespedes', $dbAdapter, null, $resultSetPrototype);
                                },   
                                        
                                ),                                        



         );
     }
 }