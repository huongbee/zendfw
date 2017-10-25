<?php
namespace Users\Service;

class AuthManager{

    private $authenticationService;
    private $sessionManager;

    public function __construct($authenticationService,$sessionManager){
        $this->authenticationService = $authenticationService;
        $this->sessionManager = $sessionManager;
    }
}


?>