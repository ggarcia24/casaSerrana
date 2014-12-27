<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Reserva\Controller\Reserva' => 'Reserva\Controller\ReservaController',
         ),
     ),
    'view_helpers' => array(
         'invokables' => array(
             'test_helper' => 'Reserva\View\Helper\Testhelper',
             'test_habitacion' => 'Reserva\View\Helper\Habitacionhelper',
         ),
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
                     'route'    => '/reserva[/][:action][/:id]',
                      'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
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
             'reserva' => __DIR__ . '/../view',
         ),
     ),
 );