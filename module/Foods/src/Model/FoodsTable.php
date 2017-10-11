<?php
namespace Foods\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Sql;

class FoodsTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    //select()
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    //getTable()
    public function getTableName(){
        return $this->tableGateway->getTable();
    }

    //getAdapter()
    public function selectData(){
        $adapter = $this->tableGateway->getAdapter();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('foods');
        $select->where(['id'=>2]); //select * from foods where id=2

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        // $selectString = $sql->buildSqlString($select);
        // $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        return $results;
    }

    public function selectData02(){
        $adapter = $this->tableGateway->getAdapter();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        $select->columns(['mamon'=>'id','tenmon'=>'name','dongia'=>'price']);
        $select->join(['ft'=>'food_type'],'f.id_type = ft.id',[],$select::JOIN_LEFT);

        $select->where(['f.id'=>2]); 
        //select f.id as mamon,f.name as tenmonan, f.price as dongia from foods as f where id=2

        $selectString = $sql->buildSqlString($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        return $results;
    }

}