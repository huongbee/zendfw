<?php
namespace Users\Service;
use Zend\Authentication\Result;

class AuthManager{

    private $authenticationService;
    private $sessionManager;

    public function __construct($authenticationService,$sessionManager){
        $this->authenticationService = $authenticationService;
        $this->sessionManager = $sessionManager;
    }

    public function login($username, $password, $rememberMe){
        if($this->authenticationService->hasIdentity()){
            throw new \Exception('Bạn đã đăng nhập');
        }
        $authAdapter = $this->authenticationService->getAdapter();
        $authAdapter->setUsername($username);
        $authAdapter->setPassword($password);

        $result = $this->authenticationService->authenticate();
        if($result->getCode() == Result::SUCCESS && $rememberMe){
            $this->sessionManager->rememberMe(86400*30);
        }
        return $result;
    }

    public function logout(){
        if($this->authenticationService->hasIdentity()){
            $this->authenticationService->clearIdentity();
        }
        else{
            throw new \Exception('Bạn chưa đăng nhập');
        }
    }
}


?>