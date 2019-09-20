<?php

namespace App\Entity;

class User{

    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $avatar;
    private $createdAt;
     
    public function __construct(array $data=[]){
        if(!empty($data)){
            $this->bind($data);
        }
    }

    public function bind(array $data){
        foreach($data as $field=>$value){
            $setter= 'set'.ucFirst($field);
            if(method_exists($this,$setter)){
                $this->$setter($value);
            }
        }
    }

    public function getId():?int{
        return $this->id;
    }

    public function setId(int $id){
        $this->id=$id;
    } 
    public function getFirstname():?string{
        return $this->firstname;
    }

    public function setFirstname(string $firstname){
        $this->firstname=$firstname;
    } 
    public function getLastname():?string{
        return $this->lastname;
    }

    public function setLastname(string $lastname){
        $this->lastname=$lastname;
    } 
    public function getEmail():?string{
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email=$email;
    } 
    public function getPassword():?string{
        return $this->password;
    }

    public function setPassword(string $password){
        $this->password=$password;
    } 
    public function getAvatar():?string{
        return $this->avatar;
    }

    public function setAvatar(string $avatar){
        $this->avatar=$avatar;
    } 

    public function getCreatedAt():?int{
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt){
        $this->createdAt=$createdAt;
    } 
}