<?php
namespace Users\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Entity\Users;
use Users\Form\UserForm;
use Users\Form\ChangePasswordForm;
use Users\Form\ResetPasswordForm;

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
            $data = [
                'username'=> $user->getUsername(),
                'email' => $user->getEmail(),
                'fullname'=>$user->getFullname(),
                'birthdate'=>$user->getBirthdate(),
                'gender'=>$user->getGender(),
                'address'=>$user->getAddress(),
                'phone'=>$user->getPhone(),
                'role'=>$user->getRole()
            ];
            $form->setData($data);
            return new ViewModel(['form'=>$form,'user'=>$user]);
        }
        $data = $this->params()->fromPost();
        $form->setData($data);
        if($form->isValid()){
            $data = $form->getData();
            $this->userManager->editUser($user,$data);
            $this->flashMessenger()->addSuccessMessage('Cập nhật thành công');
            return $this->redirect()->toRoute('user');
        }

    }

    public function deleteAction(){
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
        
        if($this->getRequest()->isPost()){
            $btn = $this->getRequest()->getPost('delete','No');
            if($btn=="Yes"){
                $this->userManager->removeUser($user);
                $this->flashMessenger()->addSuccessMessage('Xóa thành công');
            }
            return $this->redirect()->toRoute('user');
        }
        return new ViewModel(['user'=>$user]);
    }

    public function changePasswordAction(){
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
        $form = new ChangePasswordForm();
        if($this->getRequest()->isPost()){
            
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $check = $this->userManager->changePassword($user,$data);
                if(!$check){
                    $this->flashMessenger()->addErrorMessage('Mật khẩu cũ chưa đúng, vui lòng kiểm tra lại');
                    return $this->redirect()->toRoute('user',['action'=>'change-password','id'=>$user->getId()]);
                }
                else{
                    $this->flashMessenger()->addSuccessMessage('Mật khẩu đã thay đổi');
                    return $this->redirect()->toRoute('user');
                }
            }
        }
        return new ViewModel(['form'=>$form]);
        //111111!!
        //111111!!@
        //111111!!@@
    }

    public function resetPasswordAction(){
        $form = new ResetPasswordForm;
        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $user = $this->entityManager->getRepository(Users::class)->findOneByEmail($data['email']);
                if($user !==null){
                    $this->userManager->createTokenPasswordReset($user);
                    $this->flashMessenger()->addSuccessMessage('Kiểm tra hộp thư để Reset Password!');

                }
                else{
                    $this->flashMessenger()->addErrorMessage('Email không tồn tại');
                }
                return $this->redirect()->toRoute('resetpassword');
            }
        }
        return new ViewModel(['form'=>$form]);
    }

    public function setPasswordAction(){
        $token = $this->params()->fromRoute('token',null);
        if($token == null || strlen($token)!=32){
            throw new \Exception("Token không hợp lệ");
        }
        if(!$this->userManager->checkResetPasswordToken($token)){
            throw new \Exception("Token không hợp lệ hoặc đã hết hạn sử dụng. Vui lòng thử lại");
        }
        
        $form = new ChangePasswordForm('resetPw');
        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                if($this->userManager->setNewPasswordByToken($token, $data['new_pw'])){
                    $this->flashMessenger()->addSuccessMessage('Đổi mật khẩu thành công');
                    return $this->redirect()->toRoute('user');
                }
                else{
                    $this->flashMessenger()->addErrorMessage('Email không tồn tại');
                    return $this->redirect()->toRoute('setpassword',['token'=>$token]);
                    //123456!!!
                    //$2y$10$MgLmhBe/VLoXhRuB4xBKhuPd2S1UtfWb0VSO9EEx4bwitAbTd72PK

                    // 123456!@#
                    //$2y$10$Bq1SC8iuO8AdUxVseudz0uhTYPO4PX2NISO5EiUHPksrThcgrTsr6
                }
            }
        }
        return new ViewModel(['form'=>$form]);
    }
}


?>