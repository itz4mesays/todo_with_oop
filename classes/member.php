<?php
require __DIR__.'../../config/db_config.php';
require __DIR__.'/user.php';

class Member extends User
{
    public $role;
    private $db;

    private $id;
    private $conn;

    public function __construct(){
        parent::__construct();
        $this->db = new Database();
        $this->conn = $this->db->setConnection();
        $this->role = 'Member';
    }

    public function setId($id){
        $this->id = $id;
    }

    public function view()
    {
        if(isset($this->id) && !empty($this->id)){
            $pdo = $this->conn;
            
            $stmt = $pdo->prepare("SELECT * FROM todo_list WHERE id=? AND owner_id=?");
            $stmt->execute([$this->id, $_SESSION['loggedIn']]);
            $singleTodo = $stmt->fetchObject();

            if($singleTodo == true){
                return $singleTodo;
            }else{
                header("Location: view_todos.php");
                exit();
            }
        }else{
            header("Location: view_todos.php");
            exit();
        }
    }

    /**
     * Fetch all todos for a specific member
     */
    public function fetchAll()
    {
        try {
            //code...
            $pdo = $this->conn;
            $id = $_SESSION['loggedIn'];
            $stmt = $pdo->prepare("SELECT * FROM todo_list WHERE owner_id= ?");
            $stmt->execute([$id]);
            $allTodos = $stmt->fetchAll();

            return $allTodos;
        } catch (\PDOException $e) {
            //throw $th;
            return false;
        }
    }

    /**
   * Insert Member
   */
  public function createUser()
  {
    //   $options = array("cost"=>4);

      try {
        //code...
        $data = [
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'role' => $this->role,
            'password' => password_hash(parent::getPassword(), PASSWORD_BCRYPT),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        $pdo = $this->conn;
        $sql = "INSERT INTO user (username, firstname, lastname, email, password, role, created_at, updated_at) VALUES (:username, :firstname, :lastname, :email, :password, :role, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return true;
    } catch (\PDOException $e) {
        return false;
    }
  }

    public function update()
    {
        
    }

    public function delete()
    {
        echo "Delete";
    }
}