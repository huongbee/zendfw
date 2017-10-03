<?php
namespace Started\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController{
    
    public function indexAction(){
        $checkMethod = $this->getRequest();
        if($checkMethod->isGet()){
            echo 'using method GET'.'<br>';
            $id = $this->params()->fromRoute('id',-1);
            $name = $this->params()->fromQuery('name','Khoa Phạm');
            echo $id;
            echo $name;


        }
        else{
            echo 'not method GET';
           // $name = $this->params()->fromPost('name','Hello KhoaPham');
            $name = $_POST['name'];
            echo $name;
        }
        /*
        getRequest():
        - isPost(); //POST
        - isGet(); //GET
        - isXmlHttpRequest() //AJAX
        - getMethod() //GET //POST //PUT...
        - getUriString() // http://localhost/zendframework/public/started
        - ... 

        */
        $view = new ViewModel;
        return $view;
    }
    public function loginAction(){
        $checkMethod = $this->getRequest();
        if($checkMethod->isGet()){
            $method = 'using method GET';
            $id = $this->params()->fromRoute('id',-1);
            $name = $this->params()->fromQuery('name','Khoa Phạm');
            
        }
        else{
            $method = 'not method GET';
            $name = $this->params()->fromPost('name','Hello KhoaPham');
            $id = $this->params()->fromRoute('id',-1);
           
        
        }
        if($id<0){
            // $this->getResponse()->setStatusCode(404);
            // return;
            throw new \Exception("Id $id không tìm thấy");
        }
        // return new ViewModel([
        //     'id' => $id,
        //     'name'=> $name,
        //     'method' => $method
        // ]);
        //tên module/tên controller/tên action

        $view = new ViewModel([
            'id' => $id,
            'name'=> $name,
            'method' => $method
        ]);
        $view->setTemplate('started/dangnhap');
        return $view;
    }

    public function registerAction(){
        return new ViewModel();
    }

    public function aboutAction(){
        return false;
    }

}


?>