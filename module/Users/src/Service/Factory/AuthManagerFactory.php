<?php
namespace Users\Service\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\AuthenticationService;
use Users\Service\AuthManager;

class AuthManagerFactory  implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authenticationService = $container->get(AuthenticationService::class);
        $sessionManager = $container->get(SessionManager::class);
        return new AuthManager($authenticationService,$sessionManager);
    }
}

?>