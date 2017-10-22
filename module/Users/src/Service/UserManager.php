<?php
namespace Users\Service;
use Users\Entity\Users;
use Zend\Crypt\Password\Bcrypt;

class UserManager{

    private $entityManager;
    public function __construct($entityManager){
        $this->entityManager = $entityManager;
    }

    public function checkEmailExists($email){
        $user = $this->entityManager->getRepository(Users::class)->findOneByEmail($email);
        // if($user!==null) return true;
        // return false;
        return $user !== null;
    }

    public function checkUsernameExists($username){
        $user = $this->entityManager->getRepository(Users::class)->findOneByUsername($username);
        return $user !== null;
    }

    public function addUser($data){
        if($this->checkEmailExists($data['email'])){
            throw new \Exception("Email ".$data['email']." đã có người sử dụng");
        }
        if($this->checkUsernameExists($data['username'])){
            throw new \Exception("Username ".$data['username']." đã có người sử dụng");
        }
         //`id`, `username`, `password`,
        // `fullname`, `birthdate`, `gender`, `address`, `email`, `phone`, `role`
        $user = new Users;
        $user->setUsername($data['username']);
        $user->setFullname($data['fullname']);

        $birthdate = new \DateTime($data['birthdate']);
        $birthdate->format('Y-m-d');
        $user->setBirthdate($birthdate);
        $user->setGender($data['gender']);
        $user->setAddress($data['address']);
        $user->setEmail($data['email']);
        $user->setPhone($data['phone']);
        $user->setRole($data['role']);

        $bcrypt = new Bcrypt();
        $securePass = $bcrypt->create($data['password']);
        $user->setPassword($securePass);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;

        //111111!!
    }
}

?>