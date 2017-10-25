<?php
namespace Users\Service\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\AuthenticationService;
use Users\Service\AuthAdapter;
use Zend\Authentication\Storage\Session;

class AuthenticationServiceFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authAdapter = $container->get(AuthAdapter::class);
        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new Session("Zend_Auth",'session',$sessionManager);
        return new AuthenticationService($authStorage, $authAdapter);
    }
}
?>