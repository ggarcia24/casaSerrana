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
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'map' => array(
                'view/css/datepicker.css' => __DIR__ . '/../src/facturascripts/view/css/datepicker.css',
                'view/css/custom.css' => __DIR__ . '/../src/facturascripts/view/css/custom.css',
                'view/js/base.js' => __DIR__ . '/../src/facturascripts/view/js/base.js',
                'view/js/bootstrap-datepicker.js' => __DIR__ . '/../src/facturascripts/view/js/bootstrap-datepicker.js',
                'view/js/jquery.ui.shake.js' => __DIR__ . '/../src/facturascripts/view/js/jquery.ui.shake.js',
                'view/js/jquery.validate.min.js' => __DIR__ . '/../src/facturascripts/view/js/jquery.validate.min.js',
                'view/js/nueva_compra.js' => __DIR__ . '/../src/facturascripts/view/js/nueva_compra.js',
                'view/js/nueva_venta.js' => __DIR__ . '/../src/facturascripts/view/js/nueva_venta.js',
                'plugins/albaranes_almacenes/view/js/nueva_transferencia.js' => __DIR__ . '/../src/facturascripts/plugins/albaranes_almacenes/view/js/nueva_transferencia.js',
            ),
        ),
    ),

);