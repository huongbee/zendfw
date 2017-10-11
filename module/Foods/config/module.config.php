<?php
namespace Foods;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    // 'controllers' => [
    //     'factories' => [
    //         Controller\FoodsController::class => InvokableFactory::class,
    //     ],
    // ],
    'view_manager' => [
        'template_path_stack' => [
            'foods' => __DIR__ . '/../view',
        ],
    ],
    'router'=>[
        'routes' => [
            'foods' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/foods[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\FoodsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ]
];