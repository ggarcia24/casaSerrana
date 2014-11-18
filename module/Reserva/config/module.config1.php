<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Reserva\Controller\Reserva' => 'Reserva\Controller\ReservaController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
            'reserva' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/reserva',
                        'defaults' => array(
                         'controller' => 'Reserva\Controller\Reserva',
                         'action'     => 'index',
                     ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'book' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/book/[/:id]',
                            'defaults' => array(
                                'controller' => 'reserva',
                                'action' => 'index'
                            )
                        )
                    ),
                    'pipeline-period' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/pipeline/[:period]/[:type]',
                            'constraints' => array(
                                'period' => '(this|previous|last|next|current)',
                                'type' => '(week|month|quarter|year)'
                            ),
                            'defaults' => array(
                                'controller' => 'pipeline',
                                'action' => 'view'
                            )
                        )
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
