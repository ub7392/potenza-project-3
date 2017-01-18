<?php
$route = new Zend_Controller_Router_Route(
    'api',
    array(
      'router' => [
        'routes' => [
            'people' => [
                'type' => \Zend\Router\Http\Literal::class,
                'options' => [
                    'route'    => '/people',
                    'defaults' => [
                        'controller' => PeopleController::class,
                        'action'     => 'showAll',
                    ],
                ],
            ],
            'states' => [
                'type' => \Zend\Router\Http\Literal::class,
                'options' => [
                    'route'    => '/states',
                    'defaults' => [
                        'controller' => StatesController::class,
                        'action'     => 'showAll',
                    ],
                ],
            ],
            'visits' => [
                'type' => \Zend\Router\Http\Literal::class,
                'options' => [
                    'route'    => '/visits',
                    'defaults' => [
                        'controller' => VisitsController::class,
                        'action'     => 'showAll',
                    ],
                ],
            ],
            'people-add' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route'    => '/people/:id',
                    'defaults' => [
                        'controller' => PeopleController::class,
                        'action'     => 'detail',
                    ],
                    'constraints' => [
                        'id' => '\d+',
                    ],
                ],
            ],
            'visits-add' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route'    => '/visits/:id',
                    'defaults' => [
                        'controller' => VisitsController::class,
                        'action'     => 'detail',
                    ],
                    'constraints' => [
                        'id' => '\d+',
                    ],
                ],
            ],
        ],
    ]
  )
);

$router->addRoute('api', $route);


//this is a general route approach
//Routing is done as a stack, meaning last in, first out (LIFO).
//The trick is to define your most general routes first, and your most specific routes last.
/*array(
  'router' => [
    'routes' => [
        'people' => [
            'type' => \Zend\Router\Http\Literal::class,
            'options' => [
                'route'    => '/people',
                'defaults' => [
                    'controller' => PeopleController::class,
                    'action'     => 'showAll',
                ],
            ],
        ],
        'states' => [
            'type' => \Zend\Router\Http\Literal::class,
            'options' => [
                'route'    => '/states',
                'defaults' => [
                    'controller' => StatesController::class,
                    'action'     => 'showAll',
                ],
            ],
        ],
        'visits' => [
            'type' => \Zend\Router\Http\Literal::class,
            'options' => [
                'route'    => '/visits',
                'defaults' => [
                    'controller' => VisitsController::class,
                    'action'     => 'showAll',
                ],
            ],
        ],
        'people-add' => [
            'type' => \Zend\Router\Http\Segment::class,
            'options' => [
                'route'    => '/people/:id',
                'defaults' => [
                    'controller' => PeopleController::class,
                    'action'     => 'detail',
                ],
                'constraints' => [
                    'id' => '\d+',
                ],
            ],
        ],
        'visits-add' => [
            'type' => \Zend\Router\Http\Segment::class,
            'options' => [
                'route'    => '/visits/:id',
                'defaults' => [
                    'controller' => VisitsController::class,
                    'action'     => 'detail',
                ],
                'constraints' => [
                    'id' => '\d+',
                ],
            ],
        ],
    ],
]
);*/


//this is the child route approach
//Routing is done as a stack, meaning last in, first out (LIFO).
//The trick is to define your most general routes first, and your most specific routes last.

//Child routes inherit all options from their respective parents;
//this means that if an option, such as the controller default, doesn't change, you do not need to redefine it.

//Additionally, child routes match relative to the parent route. This provides several optimizations:
//You do not need to duplicate common path segments.
//Routing will ignore the child routes unless the parent matches, which can provide enormous performance benefits during routing.
/*'router' => [
    'routes' => [
        'people' => [
            // First we define the basic options for the parent route:
            'type' => \Zend\Router\Http\Literal::class,
            'options' => [
                'route'    => '/people',
                'defaults' => [
                    'controller' => PeopleController::class,
                    'action'     => 'showAll',
                ],
            ],
            // The following allows "/people" to match on its own if no child
            // routes match:
            'may_terminate' => true,

            // Child routes begin:
            'single' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route'    => '/:id',
                    'defaults' => [
                        'action' => 'detail',
                    ],
                    'constraints' => [
                        'id' => '\d+',
                    ],
                ],
            ],
        ],
        'states' => [
            'type' => \Zend\Router\Http\Literal::class,
            'options' => [
                'route'    => '/states',
                'defaults' => [
                    'controller' => StatesController::class,
                    'action'     => 'showAll',
                ],
            ],
        ],
        'visits' => [
            'type' => \Zend\Router\Http\Literal::class,
            'options' => [
                'route'    => '/visits',
                'defaults' => [
                    'controller' => VisitsController::class,
                    'action'     => 'showAll',
                ],
            ],

            // The following allows "/people" to match on its own if no child
            // routes match:
            'may_terminate' => true,

            // Child routes begin:
            'single' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route'    => '/:id',
                    'defaults' => [
                        'action' => 'detail',
                    ],
                    'constraints' => [
                        'id' => '\d+',
                    ],
                ],
            ],
        ],
    ],
];*/
