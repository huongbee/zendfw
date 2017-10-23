<?php
namespace Users\Entity;
use Doctrine\ORM\Mapping as Mapping;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="users")
 */
class Users{
    //`id`, `username`, `password`,
    // `fullname`, `birthdate`, `gender`, `address`, `email`, `phone`, `role`

    /**
     * @Mapping\Id
     * @Mapping\Column(type="integer")
     * @Mapping\GeneratedValue
     */
    private $id;

    /** @Mapping\Column(type="string") */
    private $username;

    /** @Mapping\Column(type="string") */
    private $password;

    /** @Mapping\Column(type="string") */
    private $fullname;

    /** @Mapping\Column(type="datetime") */
    private $birthdate;

    /** @Mapping\Column(type="string") */
    private $gender;

    /** @Mapping\Column(type="string") */
    private $address;

    /** @Mapping\Column(type="string", name="email", unique=TRUE) */
    private $email;

    /** @Mapping\Column(type="string", name="phone") */
    private $phone;

    /** @Mapping\Column(type="string" , name="role") */
    private $role;

    /** @Mapping\Column(type="string" , name="pw_reset_token") */
    private $pw_reset_token;

    /** @Mapping\Column(type="datetime" , name="pw_reset_token_date") */
    private $pw_reset_token_date;


    //`id`, `username`, `password`,
    // `fullname`, `birthdate`, `gender`, `address`, `email`, `phone`, `role`
    /**
     * @return
     */
    public function getPasswordResetTokenDate(){
        return $this->pw_reset_token_date;
    }

    /**
     * @param
     */
    public function setPasswordResetTokenDate($pw_reset_token_date){
        $this->pw_reset_token_date = $pw_reset_token_date;
    }
    /**
     * @return
     */
    public function getPasswordResetToken(){
        return $this->pw_reset_token;
    }

    /**
     * @param
     */
    public function setPasswordResetToken($pw_reset_token){
        $this->pw_reset_token = $pw_reset_token;
    }

    /**
     * @return
     */
    public function getRole(){
        return $this->role;
    }

    /**
     * @param
     */
    public function setRole($role){
        $this->role = $role;
    }
    /**
     * @return
     */
    public function getPhone(){
        return $this->phone;
    }

    /**
     * @param
     */
    public function setPhone($phone){
        $this->phone = $phone;
    }
    /**
     * @return
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @param
     */
    public function setEmail($email){
        $this->email = $email;
    }
    /**
     * @return
     */
    public function getAddress(){
        return $this->address;
    }

    /**
     * @param
     */
    public function setAddress($address){
        $this->address = $address;
    }
    /**
     * @return
     */
    public function getGender(){
        return $this->gender;
    }

    /**
     * @param
     */
    public function setGender($gender){
        $this->gender = $gender;
    }
    /**
     * @return
     */
    public function getBirthdate(){
        return $this->birthdate;
    }

    /**
     * @param
     */
    public function setBirthdate($birthdate){
        $this->birthdate = $birthdate;
    }
    /**
     * @return
     */
    public function getFullname(){
        return $this->fullname;
    }

    /**
     * @param
     */
    public function setFullname($fullname){
        $this->fullname = $fullname;
    }

    /**
     * @return
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @param
     */
    public function setPassword($password){
        $this->password = $password;
    }
    /**
     * @return
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * @param
     */
    public function setUsername($username){
        $this->username = $username;
    }
}


?>