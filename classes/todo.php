<?php
// session_start();

require __DIR__.'../../config/db_config.php';

class Todo
{
  private $db;

  private $id;
  private $conn;
  public $todo_title;
  public $todo_desc;
  private $user_id;
  public $status;
  public $created_at;
  public $updated_at;

  public $errors = [];

  public function __construct(){
    $this->db = new Database();
    $this->conn = $this->db->setConnection();
  }

  public function setTodoTitle($title){
    $this->todo_title = $title;
  }

  public function setTodoDesc($description){
    $this->todo_desc = $description;
  }

  public function setId($id){
    $this->id = $id;
  }

  public function getId(){
    return $this->id;
  }

  public function getUserId(){
    return $this->user_id;
  }

  public function getTodoTitle(){
    return $this->todo_title;
  }

  public function getTodoDesc(){
    return $this->todo_desc;
  }


  /**
   * Insert TODO
   */
  public function insertTodo()
  {
      try {
        //code...
        $data = [
            'owner_id' => $_SESSION['loggedIn'],
            'todo_title' => $this->todo_title,
            'todo_desc' => $this->todo_desc,
            'status' => $this->status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $pdo = $this->conn;
        $sql = "INSERT INTO todo_list (owner_id, todo_title, todo_desc, status, created_at, updated_at) VALUES (:owner_id, :todo_title, :todo_desc, :status, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return true;
    } catch (\PDOException $e) {
        return false;
    }
  }

  public function updateTodo()
  {
    try {
      //code...
      $data = [
            'todo_title' => $this->todo_title,
            'todo_desc' => $this->todo_desc,
            'status' => $this->status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $user_id = $_SESSION['loggedIn'];

        $pdo = $this->conn;
        $sql = "UPDATE todo_list SET todo_title=:todo_title, todo_desc= :todo_desc, status= :status, updated_at= :updated_at WHERE id='".$this->id."' AND owner_id='".$user_id."'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return true;
    } catch (\PDOException $e) {
      // die($e->getMessage());
       return false;
    }
  }


}
