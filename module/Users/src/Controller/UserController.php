<?php
namespace Users\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Entity\Users;
use Users\Form\UserForm;

class UserController extends AbstractActionController{

    private $entityManager;
    private $userManager;

    public function __construct($entityManager, $userManager){
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
    }

    public function indexAction(){
        $users = $this->entityManager->getRepository(Users::class)->findAll();
        //$users = $this->entityManager->getRepository(Users::class)->findBy([]);
        return new ViewModel(['users'=>$users]);
    }

    public function addAction(){
        $form = new UserForm('add');
        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                $user = $this->userManager->addUser($data);
                $this->flashMessenger()->addSuccessMessage('Thêm thành công');
                return $this->redirect()->toRoute('user');

            }
        }
        return new ViewModel(['form'=>$form]);
    }

    public function editAction(){
        $idUser = $this->params()->fromRoute('id',0);
        if($idUser<=0){
            $this->getResponse()->setStatusCode('404');
            return;
        }

        $user = $this->entityManager->getRepository(Users::class)->find($idUser);
        if(!$user){
            $this->getResponse()->setStatusCode('404');
            return;
        }
        //
        $form = new UserForm('edit');
        if(!$this->getRequest()->isPost()){
            return new ViewModel(['form'=>$form]);
        }

    }

}


?>