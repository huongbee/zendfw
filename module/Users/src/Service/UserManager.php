<?php
namespace Users\Service;
use Users\Entity\Users;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

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

    public function editUser($user,$data){
        $sql = "select u from Users\Entity\Users u where u.email ='".$data['email']."' and u.username !='".$data['username']."'";
        $q = $this->entityManager->createQuery($sql);
        $users = $q->getResult();
        
        if(!empty($users)){
            throw new \Exception("Email ".$data['email']." đã có người sử dụng");
        }
        // if($this->checkEmailExists($data['email'])){
        //     throw new \Exception("Email ".$data['email']." đã có người sử dụng");
        // }
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

        $this->entityManager->flush();
        return $user;
    }

    public function removeUser($user){
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function verifyPassword($securePass,$password ){
        $bcrypt = new Bcrypt();        
        if ($bcrypt->verify($password, $securePass)) {
            return true;
        } 
        return false;
    }

    public function changePassword($user,$data){
        $securePass = $user->getPassword();
        $password = $data['old_pw'];
        if(!$this->verifyPassword($securePass,$password)){
            return false;
        }
        $newPassword = $data['new_pw'];

        $bcrypt = new Bcrypt();
        $securePass = $bcrypt->create($newPassword);
        $user->setPassword($securePass);

        $this->entityManager->flush();
        return true;
    }

    public function createTokenPasswordReset($user){
        $token = Rand::getString(32,"0123456789qwertyuiopasdfghjklzxcvbnm", true);
        $user->setPasswordResetToken($token);

        $dateCreate = date('Y-m-d H:i:s');
        $dateCreate = new \DateTime($dateCreate);
        $dateCreate->format('Y-m-d H:i:s');
        $user->setPasswordResetTokenDate($dateCreate);
        $this->entityManager->flush();

        $http = isset($_SERVER['HTTPS']) ? "https://" : "http://";
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "localhost";
        $url = $http.$host."/zendframework/public/set-password/".$token;

        $bodyMessage = "Chào bạn, ".$user->getFullname()."
                        \nBạn vui lòng chọn vào link bên dưới để thực hiện reset password:
                        \n$url
                        \nNếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua thông báo này.
                        ";


        $message = new Message();
        $message->addTo($user->getEmail());
        $message->addFrom("huonghuong08.php@gmail.com");
        $message->setSubject('ResetPassword!');
        $message->setBody($bodyMessage);

        $transport = new SmtpTransport();
        $options   = new SmtpOptions([
            'name'              => 'smtp.gmail.com',
            'host'              => 'smtp.gmail.com',
            'port'              => 587,
            'connection_class'  => 'login',
            'connection_config' => [
                'username' => 'huonghuong08.php@gmail.com',
                'password' => '0123456789999',
                'port'     => 587,
                'ssl'      => 'tls'
            ],
        ]);
        $transport->setOptions($options);
        $transport->send($message);

    }

    public function checkResetPasswordToken($token){
        $user = $this->entityManager->getRepository(Users::class)
                    ->findOneBy(['pw_reset_token'=>$token]);
        if(!$user){
            return false;
        }
        $userTokenDate = $user->getPasswordResetTokenDate()->getTimestamp();
        $now = new \Datetime('now');
        $now = $now->getTimestamp();
        if(($now - $userTokenDate) > 86400){ //24*60*60
            return false;
        }
        return true;
    }

    public function setNewPasswordByToken($token, $newPassword){
        if(!$this->checkResetPasswordToken($token)){
            return false;
        }
        $user = $this->entityManager->getRepository(Users::class)
        ->findOneBy(['pw_reset_token'=>$token]);
        if(!$user){
            return false;
        }
        else{
            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create($newPassword);
            $user->setPassword($passwordHash);
            //reset
            $user->setPasswordResetTokenDate(null);
            $user->setPasswordResetToken(null);
            $this->entityManager->flush();
            return true;
        }
    }
}

?>