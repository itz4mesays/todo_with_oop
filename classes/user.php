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

  public function setUsername($username){
    $this->username = $username;
  }

  public function setEmail($email){
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

  public function confirmUsernameEmail(){
    try {
          //code...
          $pdo = $this->conn;
          $stmt = $pdo->prepare("SELECT id FROM user WHERE username= ? OR email=?");
          $stmt->execute([$this->username, $this->email]);
          $user = $stmt->fetchObject();

          return $user;
      } catch (\PDOException $e) {
          //throw $th;
          return false;
      }
  }

  public function login()
  {
    try{
        $pdo = $this->conn;
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username= ?");
          $stmt->execute([$this->username]);
          $user = $stmt->fetchObject();

          if($user){
            if(password_verify($this->password, $user->password)){
              $_SESSION['loggedIn'] = $user->id;
              return true;
            }else{
              $_SESSION['errors'] = ['Incorrect Password'];
            }
          }else{
            $_SESSION['errors'] = ['Such username does not exist'];      
          }

           return false;
      
    }catch(\PDOException $e){
      $_SESSION['errors'] = ['Unable to log you in at the moment.'];
      return false;
    }
  }



}
