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
  public $date_of_task;
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

  public function setTaskDate($date_of_task){
    $this->date_of_task = $date_of_task;
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

  public function getTaskDate(){
    return $this->date_of_task;
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
            'date_of_task' => $this->date_of_task,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $pdo = $this->conn;
        $sql = "INSERT INTO todo_list (owner_id, todo_title, todo_desc, status, date_of_task, created_at, updated_at) VALUES (:owner_id, :todo_title, :todo_desc, :status, :date_of_task,  :created_at, :updated_at)";
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
            'date_of_task' => date('Y-m-d', strtotime($_POST['date_of_task'])),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $user_id = $_SESSION['loggedIn'];

        $pdo = $this->conn;
        $sql = "UPDATE todo_list SET todo_title=:todo_title, todo_desc= :todo_desc, status= :status, date_of_task= :date_of_task, updated_at= :updated_at WHERE id='".$this->id."' AND owner_id='".$user_id."'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return true;
    } catch (\PDOException $e) {
      // die($e->getMessage());
       return false;
    }
  }


}
