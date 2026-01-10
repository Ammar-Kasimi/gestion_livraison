<?php
namespace App\Classes;

use App\Database\Db;
use PDO;
use PDOException;

class User
{

    private $conn;
    
    public $id;
    public $name;
    public $password;
    public $role;
    public $email;
    public $address;
    public $orders=[];
    

    public function __construct()
    {
        $database = new Db();
        $this->conn = $database->connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getEmail()
    {
        return $this->email;
    }

     public function add_object($obj){
        array_push($this->orders,$obj);
    }
    public function get_count(){
        $stmt=$this->conn->prepare("select count(*) from orders");
        $stmt->execute();
    }
    public function signup($name, $email, $password, $role,$address)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role,address) VALUES (?, ?, ?, ?,?)");
         $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), $role,$address]);
        header("location:login.php");
        exit;
    }

    public function login($email, $password)
    {
        try{
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->role = $result['role'];
            $this->address =$result["address"];
            session_start();
            $_SESSION['id']   = $result['id'];
            $_SESSION['role'] = $result['role'];
           
        }
    }
    catch(PDOException $e){
     

    }
    }
    public function logout(){
        $_SESSION=array();
        session_destroy();
        
    }
    public function show_order_list() {}

    public function show_offer_list() {}

    public function show_user_list() {}

    public function activate_account($Id) {}

    public function delete_account($Id) {}

    public function modify_role($Id, $role) {}

    public function show_activity() {}
}


