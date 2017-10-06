<?php
namespace Database\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class SqlController extends AbstractActionController{

    public function AdapterDB(){
        $adapter = new Adapter([
            'driver'=>'Pdo_Mysql',
            'database'=>'zendframework',
            'username'=>'root',
            'password'=>'',
            'hostname'=>'localhost',
            'charset' =>'utf8'
        ]);
        return $adapter;
    }

    //select()
    //form()
    //where()
    public function selectAction(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('foods');
        $select->where(['id'=>2]); //select * from foods where id=2

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        // $selectString = $sql->buildSqlString($select);
        // $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }


    //set name table
    //columns()
    public function select02Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        $select->columns(['mamon'=>'id','tenmon'=>'name','dongia'=>'price']);
        $select->where(['id'=>2]); 
        //select f.id as mamon,f.name as tenmonan, f.price as dongia from foods as f where id=2

        // $statement = $sql->prepareStatementForSqlObject($select);
        // $results = $statement->execute();
        $selectString = $sql->buildSqlString($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }

    //join()
    public function select03Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        $select->columns(['mamon'=>'id','tenmon'=>'name','dongia'=>'price']);
        $select->join(['ft'=>'food_type'],'f.id_type = ft.id',[],$select::JOIN_LEFT);

        $select->where(['f.id'=>2]); 
        //select f.id as mamon,f.name as tenmonan, f.price as dongia from foods as f where id=2

        // $statement = $sql->prepareStatementForSqlObject($select);
        // $results = $statement->execute();
        $selectString = $sql->buildSqlString($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }


}