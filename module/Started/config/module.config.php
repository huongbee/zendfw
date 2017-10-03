<?php
namespace Started;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Started\Controller\IndexController;

return [
    'router'=>[
        'routes' => [
            // 'started' => [ //name route
            //     'type'    => Segment::class,
            //     'options' => [
            //         'route'    => '/started[/:action][/:id]',
            //         'defaults' => [
            //             'controller' => Controller\IndexController::class,
            //             'action'     => 'login',
            //         ],
            //         'constraints' => [
            //             'id' => "[0-9]*",
            //             'action' => "[a-zA-Z]*"
            //         ]
            //     ],
            // ],
            // 'started' => [ //name route
            //     'type'    => Literal::class,
            //     'options' => [
            //         'route'    => '/started',
            //         'defaults' => [
            //             'controller' => 'Index',
            //             'action'     => 'index',
            //         ]
            //     ],
            // ],
            // 'login' => [ //name route
            //     'type'    => Literal::class,
            //     'options' => [
            //         'route'    => '/started/login',
            //         'defaults' => [
            //             'controller' => 'Index',
            //             'action'     => 'login',
            //         ]
            //     ],
            // ],
            // 'register' => [ //name route
            //     'type'    => Literal::class,
            //     'options' => [
            //         'route'    => '/started/register',
            //         'defaults' => [
            //             'controller' => 'Index', //1 khóa nằm trong aliases
            //             'action'     => 'register',
            //         ]
            //     ],
            // ],
            'started' => [ //name route
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/started',
                    'defaults' => [
                        //'controller' => 'Index',
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ]
                ],
                'may_terminate' => true,
                'child_routes'=>[
                    // 'login' =>[
                    //     'type'    => Literal::class,
                    //     'options' => [
                    //         'route'    => '/login',
                    //         'defaults' => [
                    //             'action'     => 'login',
                    //         ]
                    //     ]
                    // ],
                    // 'register' =>[
                    //     'type'    => Literal::class,
                    //     'options' => [
                    //         'route'    => '/register',
                    //         'defaults' => [
                    //             'action'     => 'register',
                    //         ]
                    //     ]
                    // ]
                    'user' =>[
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '[/:action][/:id]',
                            'defaults' => [
                                //'controller' => 
                                'action'     => 'login',
                            ]
                        ],
                        'constraints' => [
                            'action' => "[a-zA-Z]*"
                        ]
                    ],
                ]
            ],
        ],
    ],
    'controllers'=>[
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\UserController::class => Controller\Factory\UserControllerFactory::class
        ],
        // 'invokables' => [
        //     'Started\Controller\Index' => IndexController::class
        // ],
        // 'aliases' =>[
        //     'Index' => 'Started\Controller\Index'
        // ]

    ],
    'view_manager'=>[
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]
]



?>