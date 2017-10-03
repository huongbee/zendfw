<?php
namespace Form\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Form\Form\FormElement;

class FormElementController extends AbstractActionController{
    
    public function indexAction(){
        $form = new FormElement();
        $view = new ViewModel(['form'=>$form]);
        return $view->setTemplate('form/form-element/index');
    }

    public function getFormDataAction(){
        $method = $this->getRequest();
        if($method->isPost()){
            $formData = $this->params()->fromPost();

            echo "<pre>";
            print_r($formData);
            echo "</pre>";
        }
        $form = new FormElement();
        $view = new ViewModel(['form'=>$form]);
        return $view->setTemplate('form/form-element/get-data');
    }

    public function index02Action(){
        $method = $this->getRequest();
        if($method->isPost()){
            $formData = $this->params()->fromPost();

            echo "<pre>";
            print_r($formData);
            echo "</pre>";
        }
        $form = new FormElement();
        $view = new ViewModel(['form'=>$form]);
        return $view->setTemplate('form/form-element/index02');
    }
}

