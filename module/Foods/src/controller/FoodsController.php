<?php
namespace Foods\Controller;

use Foods\Model\FoodsTable;
use Zend\Mvc\Controller\AbstractActionController;

class FoodsController extends AbstractActionController{

    private $table;
    public function __construct(FoodsTable $table){
        $this->table = $table;
    }
    public function indexAction(){
        $foods = $this->table->fetchAll();
        foreach($foods as $food){
            echo "<pre>";
            print_r($food);
            echo "</pre>";
        }
        
        return false;
    }

    public function addAction(){
        
    }

    public function editAction(){
        
    }
    
    public function deleteAction(){
        
    }
}