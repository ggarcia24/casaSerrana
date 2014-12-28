<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Reserva\Controller\Reserva' => 'Reserva\Controller\ReservaController',
             'Reserva\Controller\Tarifa' => 'Reserva\Controller\TarifaController',
             'Reserva\Controller\TipoConvenio' => 'Reserva\Controller\TipoConvenioController',
             'Reserva\Controller\Habitacion' => 'Reserva\Controller\HabitacionController',
             'Reserva\Controller\Pabellon' => 'Reserva\Controller\PabellonController',
         ),
     ),
     'view_helpers' => array(
         'invokables' => array(
             'form_element' => 'Reserva\Form\View\Helper\FormElement',
         )
     ),
     'router' => array(
         'routes' => array(
             'gridreserva' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/reserva[/][:action][/:fechaDesde][/:fechaHasta]',
                     'defaults' => array(
                         'controller' => 'Reserva\Controller\Reserva',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'reserva' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/reserva[/][:action][/:id][/:fechaIn][/:idHabitacion]',
                      'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                         'fechaIn'     => '[0-9-]+',
                         'idHabitacion'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Reserva\Controller\Reserva',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'pabellon' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/pabellon[/][:action][/:id]',
                      'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Reserva\Controller\Pabellon',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'tarifa' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/tarifa[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Reserva\Controller\Tarifa',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'tipo-convenio' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/tipo-convenio[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Reserva\Controller\TipoConvenio',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'habitacion' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/habitacion[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Reserva\Controller\Habitacion',
                         'action'     => 'index',
                     ),
                 ),
             )
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'reserva' => __DIR__ . '/../view',
         ),
     ),
     'asset_manager' => array(
         'resolver_configs' => array(
             'map' => array(
                 'css/reserva.css' => __DIR__ . '/../public/css/style.css',
                 'js/reserva.js' => __DIR__ . '/../public/js/main.js',
             ),
         ),
     ),
 );