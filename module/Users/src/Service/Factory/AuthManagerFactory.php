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

        $config = $container->get('Config');
        if(isset($config['access_filter'])){
            $config = $config['access_filter'];
        }
        else{
            $config = [];
        }
        return new AuthManager($authenticationService,$sessionManager,$config);
    }
}

?>