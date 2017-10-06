<?php
namespace Database\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;

class AdapterController extends AbstractActionController{

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

    public function indexAction(){
        $database = $this->AdapterDB();

        $sql = "SELECT * FROM food_type LIMIT 0,4";
        $statement = $database->query($sql);
        $result = $statement->execute();
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        foreach($result as $row){
            echo '<pre>';
            print_r($row);
            echo '</pre>';
        }
        return false;
    }

    public function demo02Action(){
        $db = $this->AdapterDB();

        //$sql = "SELECT * FROM food_type WHERE id>?";
        //$statement = $db->createStatement($sql, [5]);
        //$result = $statement->execute();

        // $statement = $db->query($sql);
        // $result = $statement->execute([5]);

        $sql = "SELECT * FROM food_type WHERE id BETWEEN ? AND ?";
        $statement = $db->createStatement($sql, [5,7]);
        $result = $statement->execute();

        foreach($result as $row){
            echo '<pre>';
            print_r($row);
            echo '</pre>';
        }
        return false;

        
    }

    public function demo03Action(){

        $db = $this->AdapterDB();

        //$sql = "SELECT * FROM food_type WHERE id BETWEEN :id_start AND :id_end";
        // $statement = $db->createStatement($sql, [
        //     'id_start'=>5,
        //     'id_end'=>8
        // ]);
        // $result = $statement->execute();
        $sql = "SELECT * FROM food_type WHERE `name` like :ten";
        $statement = $db->query($sql);
        $result = $statement->execute([
            'ten'=>'%Canh%'
        ]);
        
        foreach($result as $row){
            echo '<pre>';
            print_r($row);
            echo '</pre>';
        }
        return false;
    }

    public function demo04Action(){
        $adapter = $this->AdapterDB();

        $qi = function ($name) use ($adapter) {
            return $adapter->platform->quoteIdentifier($name);
        };
        $fp = function ($name) use ($adapter) {
            return $adapter->driver->formatParameterName($name);
        };

        //$sql = "SELECT * FROM ".$qi('food_type')." WHERE ".$qi('id')." = ".$fp('ID');
        //SELECT * FROM food_type WHERE id=?

        //$sql = "SELECT * FROM ".$qi('food_type')." WHERE ".$qi('id')." = ".$fp('ID') . " OR ".$qi('id')." = ".$fp('ID_2');

        $sql = sprintf('SELECT * FROM %s WHERE %s = %s OR %s like %s',
            $qi('food_type'),
            $qi('id'),
            $fp('ID'),
            $qi('name'),
            $fp('name')
        );

        $statement = $adapter->query($sql);
        
        $parameters = [
            'ID'=>2,
            'name'=>"%canh%"
        ];
        $result = $statement->execute($parameters);
        foreach($result as $row){
            echo '<pre>';
            print_r($row);
            echo '</pre>';
        }
        return false;
    }

    //insert
    public function demo05Action(){
        $adapter = $this->AdapterDB();

        $qi = function ($name) use ($adapter) {
            return $adapter->platform->quoteIdentifier($name);
        };
        $fp = function ($name) use ($adapter) {
            return $adapter->driver->formatParameterName($name);
        };

        $sql = sprintf('INSERT INTO %s (%s,%s,%s) VALUES (%s,%s,%s)',
            $qi('food_type'),
            $qi('name'),
            $qi('description'),
            $qi('image'),
            $fp('name'),
            $fp('description'),
            $fp('image')
        );

        $statement = $adapter->query($sql);
        
        $parameters = [
            'name'=>"Demo insert",
            'description'=>"Demo Description...",
            'image' => 'demo.png'
        ];
        $result = $statement->execute($parameters);
        print_r($result);
        return false;
    }
}