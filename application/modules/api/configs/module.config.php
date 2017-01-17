<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'api\Controller\api' => 'api\Controller\apiController',
        ),
    ),

    'router' => array(
      'routes' => array(
        'api' => array(
          'type' => 'segment',
          'options' => array(
            'route' => '/api[/:id]',
            'contraints' => array(
              'id' => '[0-9]+',
            ),
            'defaults' => array(
              'controller' => 'api/controller/api',
            ),
          ),
        ),
      ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'api' => __DIR__ . '/../view',
        ),
    ),

    'view_manager' => array(
      'strategies' => array(
        'ViewJsonStrategy'
      ),
    ),
);
