<?php
namespace Foods;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '../config/module.config.php';
    }

    public function getServiceConfig(){
        return [
            'factories' => [
                Model\FoodsTable::class => function($container) {
                    $tableGateway = $container->get(Model\FoodsTableGateway::class);
                    return new Model\FoodsTable($tableGateway);
                },
                Model\FoodsTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Foods());
                    return new TableGateway('foods', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\FoodsController::class => function($container) {
                    return new Controller\FoodsController(
                        $container->get(Model\FoodsTable::class)
                    );
                },
            ],
        ];
    }
}
?>