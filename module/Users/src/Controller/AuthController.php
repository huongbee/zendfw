<?php
namespace Users\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Entity\Users;
use Users\Form\LoginForm;
use Zend\Authentication\Result;

class AuthController extends AbstractActionController{

    private $entityManager, $userManager, $authManager, $authService;

    public function __construct($entityManager, $userManager,$authManager,$authService){
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
        $this->authManager = $authManager;
        $this->authService = $authService;
    }

    //huonghuong
    //123456!@#
    public function loginAction(){
        $form = new LoginForm;
        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                
                $result = $this->authManager->login($data['username'], $data['password'], $data['remember']);
                // print_r($result->getCode());
                // return false;
                if($result->getCode() == Result::SUCCESS){
                    return $this->redirect()->toRoute('user');
                }
                else{
                   $message = current($result->getMessages());
                   $this->flashMessenger()->addErrorMessage($message);
                   return $this->redirect()->toRoute('login');
                }
            }

        }
        return new ViewModel(['form'=>$form]);
    }

    public function logoutAction(){
        $this->authManager->logout();
        return $this->redirect()->toRoute('login');
    }

}

?>