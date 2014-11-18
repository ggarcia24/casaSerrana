<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Proveedor\Controller\Proveedor' => 'Proveedor\Controller\ProveedorController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'proveedor' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/proveedor[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Proveedor\Controller\Proveedor',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'proveedor' => __DIR__ . '/../view',
         ),
     ),
 );
