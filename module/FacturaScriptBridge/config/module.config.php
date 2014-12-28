<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'FacturaScriptBridge\Controller\Index' => 'FacturaScriptBridge\Controller\IndexController'

        ),
    ),
    'router' => array(
        'routes' => array(
            'facturascripts' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/contabilidad',
                    'defaults' => array(
                        'controller' => 'FacturaScriptBridge\Controller\Index',
                        'action'     => 'index',
                    )
                ),
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    )
);