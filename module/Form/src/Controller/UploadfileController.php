<?php
namespace Form\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Form\Form\UploadFile;
use Zend\File\Transfer\Adapter\Http;
use Zend\Filter\File\Rename;

class UploadfileController extends AbstractActionController{

    public function indexAction(){
        $form = new UploadFile;

        $request = $this->getRequest();
        if($request->isPost()){
            $file = $request->getFiles()->toArray();
            // echo '<pre>';
            // print_r($file);
            // echo '</pre>';
            //$fileUpload = new Http();
            //$fileInfo = $fileUpload->getFileInfo();
            //echo $fileUpload->getFileSize();
            //echo $fileUpload->getFileName();
            // $fileUpload->setDestination(FILES_PATH.'upload');
            // $fileUpload->receive();
            $form->setData($file);
            if($form->isValid()){
                $fileFilter = new Rename([
                    'target'=>FILES_PATH.'upload/'.$file['file-upload']['name'],
                    'randomize' => true
    
                ]);
                $fileFilter->filter($file['file-upload']);
    
                echo 'uploaded';
            }
            // else{
            //     $messages = $form->getMessages();
            //     foreach($messages as $error){
            //         echo current($error).'<br>';
            //     }
            // }
        }

        $view = new ViewModel(['form'=>$form]);
        $view->setTemplate('form/upload-file/index');
        return $view;
    }

    public function uploadMultipleAction(){
        $form = new UploadFile;

        $request = $this->getRequest();
        if($request->isPost()){
            $file = $request->getFiles()->toArray();
            $form->setData($file);

            if($form->isValid()){
                $data = $form->getData();

                foreach($data['file-upload'] as $image){
                    $fileFilter = new Rename([
                        'target'=>FILES_PATH.'upload/'.$image['name'],
                        'randomize' => true
                    ]);
                    $fileFilter->filter($image);
                }
                echo 'uploaded';
            }
            // else{
            //     $messages = $form->getMessages();
            //     foreach($messages as $error){
            //         echo current($error).'<br>';
            //     }
            // }
        }

        $view = new ViewModel(['form'=>$form]);
        $view->setTemplate('form/upload-file/multiple');
        return $view;
    }
}
