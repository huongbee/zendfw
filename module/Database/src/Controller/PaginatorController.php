<?php
namespace Database\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter;
use Zend\Db\Adapter\Adapter as ADB;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;

class PaginatorController extends AbstractActionController{

    public function indexAction(){
        $arrayData = [
            ['name'=>"Sản phẩm 1", 'price'=>20000],
            ['name'=>"Sản phẩm 2", 'price'=>60000],
            ['name'=>"Sản phẩm 3", 'price'=>20000],
            ['name'=>"Sản phẩm 4", 'price'=>80000],
            ['name'=>"Sản phẩm 5", 'price'=>20000],
            ['name'=>"Sản phẩm 6", 'price'=>47000],
            ['name'=>"Sản phẩm 7", 'price'=>30000],
            ['name'=>"Sản phẩm 8", 'price'=>25000],
            ['name'=>"Sản phẩm 9", 'price'=>28000],
            ['name'=>"Sản phẩm 10", 'price'=>90000],
        ];

        $paginator = new Paginator(new Adapter\ArrayAdapter($arrayData));
        $currentPage = $this->params()->fromRoute('page',1);
        $paginator->setCurrentPageNumber($currentPage);
        $paginator->setItemCountPerPage(2);
        $view = new ViewModel(['paginator'=>$paginator]);
        $view->setTemplate('paginator/index');
        return $view;
    }

    public function AdapterDB(){
        $adapter = new ADB([
            'driver'=>'Pdo_Mysql',
            'database'=>'zendframework',
            'username'=>'root',
            'password'=>'',
            'hostname'=>'localhost',
            'charset' =>'utf8'
        ]);
        return $adapter;
    }

    public function index02Action(){
        $adapter = $this->AdapterDB();
        $select = new Select();
        $select->from('foods');

        $dbSelect = new DbSelect($select,$adapter);
        $paginator = new Paginator($dbSelect);
        $currentPage = $this->params()->fromRoute('page',1);
        $paginator->setCurrentPageNumber($currentPage);
        $paginator->setItemCountPerPage(5);
        $paginator->setPageRange(5);
        $view = new ViewModel(['paginator'=>$paginator]);
        $view->setTemplate('paginator/index02');
        return $view;
    }
    
}
