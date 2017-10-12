<?php
namespace Foods\Controller;

use Foods\Model\FoodsTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Foods\Form\FoodsForm;

class FoodsController extends AbstractActionController{

    private $table;
    public function __construct(FoodsTable $table){
        $this->table = $table;
    }

    public function indexAction(){
        $foods = $this->table->fetchAll();
       
        return new ViewModel(['foods'=>$foods]);
    }

    public function getTableNameAction(){
        $name = $this->table->getTableName();
        echo $name;
        return false;
    }
    public function selectDataAction(){
        $data = $this->table->selectData();
        foreach($data as $row){
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
        return false;
    }
    public function selectData02Action(){
        $data = $this->table->selectData02();
        foreach($data as $row){
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
        return false;
    }



    public function addAction(){
        $form = new FoodsForm();
        return new ViewModel(['form'=>$form]);
    }

    public function editAction(){
        
    }
    
    public function deleteAction(){
        
    }
}