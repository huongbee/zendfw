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
        //return $this->tableGateway->select();
        $adapter = $this->tableGateway->getAdapter();
        
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        $select->columns(['id','name','summary','price','promotion','image']);
        $select->join(['ft'=>'food_type'],'f.id_type = ft.id',['name_type'=>'name'],$select::JOIN_LEFT);
        $select->order('name_type ASC');
        $selectString = $sql->buildSqlString($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        return $results;
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

    public function getTypeFoods(){
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('food_type');
        $select->columns(['id','name']);
        $selectString = $sql->buildSqlString($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        return $results;
    }

    public function saveFoods(Foods $foods){
        $data = [
            'id_type'=>$foods->id_type,
            'name'=>$foods->name,
            'summary'=>$foods->summary,
            'detail'=> $foods->detail,
            'price'=>$foods->price,
            'promotion'=>$foods->promotion,
            'image'=>$foods->image,
            'update_at'=>$foods->update_at,
            'unit'=>$foods->unit,
            'today'=>$foods->today,
        ];
        $id = (int)$foods->id;
        if($id<=0){
            $this->tableGateway->insert($data);
        }
        elseif(!$this->findFoods($id)){
            throw new RuntimeException("Cập nhật không thành công. Không tìm thầy món ăn có id là: $id");
        }
        else{
            $this->tableGateway->update($data,['id'=>$id]);
        }        
        return;
    }

    public function findFoods($id){
        $id = (int)$id;
        $foods = $this->tableGateway->select(['id'=>$id]);
        $foods = $foods->current();
        if(!$foods){
            throw new RuntimeException("Không tìm thầy món ăn có id là: $id");
        }
        return $foods;
    }

    public function deleteFood($id){
        $this->tableGateway->delete(['id'=>$id]);
    }
}