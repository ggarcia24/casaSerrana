<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Cliente\Controller\Cliente'    => 'Cliente\Controller\ClienteController',
             'Cliente\Controller\Banco'      => 'Cliente\Controller\BancoController',
             'Cliente\Controller\Alimento'   => 'Cliente\Controller\AlimentoController',
             'Cliente\Controller\Tarjeta'    => 'Cliente\Controller\TarjetaController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'cliente' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/cliente[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Cliente\Controller\Cliente',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'banco' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/banco[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Cliente\Controller\Banco',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'alimento' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/alimento[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Cliente\Controller\Alimento',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'tarjeta' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/tarjeta[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Cliente\Controller\Tarjeta',
                         'action'     => 'index',
                     ),
                 ),
             ),             
             'buscador' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/reserva[/][:action][/:buscado]',
                     'defaults' => array(
                         'controller' => 'Reserva\Controller\Reserva',
                         'action'     => 'index',
                     ),
                 ),
             ),           
         ),
         
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'cliente' => __DIR__ . '/../view',
             'banco' => __DIR__ . '/../view',
             'alimento' => __DIR__ . '/../view',
             'tarjeta' => __DIR__ . '/../view',
         ),
         'strategies' => array(
            'ViewJsonStrategy',
         ),
     ),
 );
