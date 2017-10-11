<?php
namespace Foods\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class FoodsTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
}