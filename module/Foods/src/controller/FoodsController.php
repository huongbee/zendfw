<?php
namespace Foods\Controller;

use Foods\Model\FoodsTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Foods\Form\FoodsForm;
use Zend\Filter\File\Rename;
use Foods\Model\Foods;


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
        $form = new FoodsForm('add');

        $typeFoods = $this->table->getTypeFoods();
        $listTypes = [];
        foreach($typeFoods as $type){
            $listTypes[$type->id] = $type->name;
        }
        //print_r($listTypes); die;
        $form->get('id_type')->setValueOptions($listTypes);
        
        $request = $this->getRequest();
        if(!$request->isPost()){
            return new ViewModel(['form'=>$form]);
        }
        $data = $request->getPost()->toArray();
        $file = $request->getFiles()->toArray();
        $data = array_merge_recursive($data,$file);
        $form->setData($data);

        if(!$form->isValid()){
            //$this->flashMessenger()->addErrorMessage('Thêm không thành công, vui lòng kiểm tra lại');
            return new ViewModel(['form'=>$form]);
        }
        $data = $form->getData();
        
        $newName = date('Y-m-d-h-i-s').'-'.$file['image']['name'];
        $image = new Rename([
            'target'=>IMAGE_PATH.'hinh_mon_an/'.$newName,
            'overwrite'=>true
        ]);
        $image->filter($file['image']);

        $data['update_at'] = date('Y-m-d');
        $data['image'] = $newName;
        $data['promotion'] = implode($data['promotion'],', ');
        
        $foods = new Foods;
        $foods->exchangeArray($data);
        $this->table->saveFoods($foods);
        $this->flashMessenger()->addSuccessMessage('Thêm thành công');
        return $this->redirect()->toRoute('foods',['controller'=>'FoodsController','action'=>'index']);

    }

    public function editAction(){
        $id = (int)$this->params()->fromRoute('id',0);
        if($id === 0){
            return $this->redirect()->toRoute('foods',['controller'=>'FoodsController','action'=>'index']);
        }
        $food = $this->table->findFoods($id);

        $food->promotion = explode(', ',$food->promotion);

        // echo "<pre>";
        // print_r($food);
        // echo "</pre>";
        // die;

        $form = new FoodsForm('edit');
        $form->bind($food);

        $typeFoods = $this->table->getTypeFoods();
        $listTypes = [];
        foreach($typeFoods as $type){
            $listTypes[$type->id] = $type->name;
        }
        $form->get('id_type')->setValueOptions($listTypes);

        $request = $this->getRequest();
        if(!$request->isPost()){
            return new ViewModel(['form'=>$form]);
        }
        $data = $request->getPost()->toArray();
        $file = $request->getFiles()->toArray();
        if($file['image']['error']<=0){
            $data = array_merge_recursive($data,$file);
            
            $newName = date('Y-m-d-h-i-s').'-'.$file['image']['name'];
            $image = new Rename([
                'target'=>IMAGE_PATH.'hinh_mon_an/'.$newName,
                'overwrite'=>true
            ]);
            $image->filter($file['image']);
            
            $data['image'] = $newName;
        }
        else{
            $data['image'] = $form->get('image')->getValue();
        }
        $form->setData($data);
        //
        if(!$form->isValid()){
            return new ViewModel(['form'=>$form]);
        }
        //$data = $form->getData();
        //print_r($data);die;
        $food->update_at = date('Y-m-d');
        $food->promotion = implode($data['promotion'],', ');
        ///print_r($food); die;
        $this->table->saveFoods($food);
        $this->flashMessenger()->addSuccessMessage('Cập nhật thành công');
        return $this->redirect()->toRoute('foods',['controller'=>'FoodsController','action'=>'index']);
    }
    
    public function deleteAction(){
        
    }
}