<?php
namespace Users\Service;
use Zend\Authentication\Adapter\AdapterInterface;
use Users\Entity\Users;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;

class AuthAdapter implements AdapterInterface{
    private $entityManager;
    private $username;
    private $password;

    public function __construct($entityManager){
        $this->entityManager = $entityManager;
    }

    public function setUsername($username){
        $this->username = $username;
    }
    public function setPassword($password){
        $this->password = $password;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
     *     If authentication cannot be performed
     */
    public function authenticate()
    {
        $user = $this->entityManager->getRepository(Users::class)
                    ->findOneByUsername($this->username);
        if(!$user){
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Username không tồn tại']);
        }  
        else{
            $bcrypt = new Bcrypt();

            $userPassword = $this->password; //pw do người dừng nhập
            $passwordHash = $user->getPassword(); // pw đã lưu trong db
            if($bcrypt->verify($userPassword,$passwordHash)){
                return new Result(Result::SUCCESS,
                            $this->username,
                            ['Xác thực thành công']
                );
            }
            else{
                return new Result(
                    Result::FAILURE_CREDENTIAL_INVALID ,
                    null,
                    ['Sai thông tin đăng nhập. Password không chính xác']);
            }
        }          

    }

}

?>