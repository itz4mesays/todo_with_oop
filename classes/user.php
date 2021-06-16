<?php

class User
{
  private $db;

  private $id;
  private $conn;

  public $username;
  private $password;
  private $reset_token;
  public $firstname;
  public $lastname;
  public $email;
  private $role;
  public $created_at;
  public $updated_at;

  public function __construct(){
    $this->reset_token = null;
    $this->created_at = date('Y-m-d H:i:s');
    $this->updated_at = date('Y-m-d H:i:s');

    $this->db = new Database();
    $this->conn = $this->db->setConnection();
  }
  
  public function getUsername(){
    return $this->username;
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function setEmai($email){
    $this->email = $email;
  }
  
  public function setFirstname($firstname){
    $this->firstname = $firstname;
  }

  public function setLastname($lastname){
    $this->lastname = $lastname;
  }

  public function getPassword(){
    return $this->password;
  }

  public function getRole(){
    return $this->role;
  }

  public function getResetToken(){
    return $this->reset_token;
  }



}
