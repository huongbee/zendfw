<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Database;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'database' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/database',
                    'defaults' => [
                        '__NAMESPACE__'=>'Database\Controller',
                        'controller' => 'Adapter',
                        'action'     => 'index',
                    ],
                    'constraints'=>[
                        'action' => '[a-zA-Z0-9_-]*'
                    ]
                ],
                'may_terminate'=>true,
                'child_routes'=>[
                    'sub'=>[
                        'type'=>Segment::class,
                        'options'=>[
                            'route'=>'/[:controller[/:action]]',
                            'constrains'=>[
                                'controller'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'=>'[a-zA-Z][a-zA-Z0-9_-]*'
                            ]
                        ]
                    ]
                ]
            ]
        ],
    ],
    'controllers' => [
        // 'factories' => [
        //     Controller\AdapterController::class=>InvokableFactory::class
        // ],
        'invokables'=>[
            'Controller\AdapterController'=>\Database\Controller\AdapterController::class,
            'Controller\SqlController'=>\Database\Controller\SqlController::class
        ],
        'aliases'=>[
            'Adapter'=>'Controller\AdapterController',
            'Sql' => 'Controller\SqlController'
        ]
    ],
    'view_manager' => [
        
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
