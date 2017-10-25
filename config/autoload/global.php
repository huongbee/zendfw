<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Storage\SessionArrayStorage;
return [
    'db'=>[
        'driver'=>'Pdo',
        'dsn' => 'mysql:dbname=zendframework;host=localhost',
        'username'=> 'root',
        'password' => '',
        'driver_options'=>[
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
        ]
    ],
    'service_manager'=>[
        'factories'=>[
            'Zend\Db\Adapter\Adapter'=>'Zend\Db\Adapter\AdapterServiceFactory'
        ]
    ],
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'zendframework',
                    'charset' => 'utf8'
                ],
            ],
        ],
    ],
    'session_config' => [
        'cookie_lifetime' => 3600,//1h
        'gc_maxlifetime'  => 2*3600
    ],
    'session_manager'=>[
        'validators'=>[
            RemoteAddr::class,
            HttpUserAgent::class
        ]
    ],
    'session_storage'=>[
        'type' => SessionArrayStorage::class
    ]
];
