<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Reserva\Controller\Reserva' => 'Reserva\Controller\ReservaController',
         ),
     ),
     'router' => array(
         'routes' => array(
             'reserva' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/reserva[/][:action][/:id]',
                     //'route'    => '/reserva[/][:action][/:fechaDesde][/:fechaHasta]',
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
