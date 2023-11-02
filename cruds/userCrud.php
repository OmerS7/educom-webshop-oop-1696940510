<?php

class userCrud{

    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }

    //readUserByEmail
    public function findUserByEmail($email){
        $sql ="SELECT * FROM users WHERE email =:email";
        $params = array('email' => $email);
        return $this->crud->readOneRow($sql, $params);
    }

    //readUserById
    public function findUserById($userId){
        $sql ="SELECT * FROM users WHERE id =:Id";
        $params = array('id' => $userId);
        return $this->crud->readOneRow($sql, $params);
    }


    //createUser
    public function saveUser($email, $username, $password){
        $sql ="INSERT INTO users (`username`, `email`,`password`) 
               VALUES (:username, :email, :`password`)";
        $params = array('email' => $email, 'username' => $username, 'password' => $password);
        return $this->crud->createRow($sql, $params);
    }


    //updateUser
    public function saveChangePassword($id,$password){
        $sql="UPDATE users SET password = :password WHERE id = :id";
        $params = array('id' => $id, 'password' => $password);
        return $this->crud->updateRow($sql, $params);
    }


    //createContact
    public function saveContact($name,$phone,$email,$salutation,$communication,$comment){
        $sql ="INSERT INTO contact (`name`, phone, email, salutation, communication, comment)
               VALUES (:`name`, :phone, :email, :salutation, :communication, :comment)";
        $params = array('name' => $name, 'phone' => $phone, 'email' => $email, 'salutation' => $salutation,
                        'communicatin' => $communication, 'comment' => $comment);
        return $this->crud->createRow($sql, $params);
    }
}


