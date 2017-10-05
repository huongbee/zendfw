<?php
namespace Form\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Form\Form\UploadFile;

class UploadfileController extends AbstractActionController{

    public function indexAction(){
        $form = new UploadFile;

        $view = new ViewModel(['form'=>$form]);
        $view->setTemplate('form/upload-file/index');
        return $view;
    }
}
