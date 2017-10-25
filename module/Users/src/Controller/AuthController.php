<?php
namespace Users\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Entity\Users;

class AuthController extends AbstractActionController{

    private $entityManager, $userManager, $authManager, $authService;

    public function __construct($entityManager, $userManager,$authManager,$authService){
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
        $this->authManager = $authManager;
        $this->authService = $authService;
    }

}

?>