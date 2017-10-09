<?php
namespace Database\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Ddl;
use Zend\Db\Sql\Ddl\Column;
use Zend\Db\Sql\Ddl\Constraint;

class DdlController extends AbstractActionController{
    
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

    //crate table
    public function creatTableAction(){
        $table = new Ddl\CreateTable('demo');
        $table->addColumn(new Column\Integer('id'));
        $table->addColumn(new Column\Varchar('name', 255));
        $table->addConstraint(new Constraint\PrimaryKey('id'));
        $table->addConstraint(
            new Constraint\UniqueKey(['name'], 'my_unique_key')
        );

        $adapter = $this->AdapterDB();
        $sql = new Sql($adapter);
        
        $adapter->query(
            $sql->getSqlStringForSqlObject($table),
            $adapter::QUERY_MODE_EXECUTE
        );
        echo 'Executed';
        echo "<hr>";
        echo $sql->getSqlStringForSqlObject($table);
        return false;
    }

    //alter table
    public function alterTableAction(){
        $table = new Ddl\AlterTable('demo');
        
        $table->addColumn(new Column\VarChar('email', 100));
        $table->changeColumn('name', new Column\Varchar('new_name', 50));

        $adapter = $this->AdapterDB();
        $sql = new Sql($adapter);
        
        $adapter->query(
            $sql->getSqlStringForSqlObject($table),
            $adapter::QUERY_MODE_EXECUTE
        );
        echo 'Executed';
        echo "<hr>";
        echo $sql->getSqlStringForSqlObject($table);
        return false;
    }


    public function creatTable02Action(){
        $table = new Ddl\CreateTable('demo_02');
        $table->addColumn(new Column\Integer('id'));
        $table->addColumn(new Column\Varchar('name', 255));
        $table->addColumn(new Column\Integer('id_demo'));
        $table->addConstraint(new Constraint\PrimaryKey('id'));
        $table->addConstraint(
            new Constraint\ForeignKey('foreign_key','id_demo','demo','id')
        );

        $adapter = $this->AdapterDB();
        $sql = new Sql($adapter);
        
        $adapter->query(
            $sql->getSqlStringForSqlObject($table),
            $adapter::QUERY_MODE_EXECUTE
        );
        echo 'Executed';
        echo "<hr>";
        echo $sql->getSqlStringForSqlObject($table);
        return false;
    }

    //deleteTable
    public function deleteTableAction(){
        $table = new Ddl\DropTable('demo_02');
        
        $adapter = $this->AdapterDB();
        $sql = new Sql($adapter);
        
        $adapter->query(
            $sql->getSqlStringForSqlObject($table),
            $adapter::QUERY_MODE_EXECUTE
        );
        echo 'Executed';
        echo "<hr>";
        echo $sql->getSqlStringForSqlObject($table);
        return false;
    }
    
}