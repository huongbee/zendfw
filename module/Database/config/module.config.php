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
                    'route'    => '/adapter[/:action]',
                    'defaults' => [
                        'controller' => Controller\AdapterController::class,
                        'action'     => 'index',
                    ],
                    'constraints'=>[
                        'action' => '[a-zA-Z0-9_-]*'
                    ]
                ],
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AdapterController::class=>InvokableFactory::class
        ],
    ],
    'view_manager' => [
        
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
