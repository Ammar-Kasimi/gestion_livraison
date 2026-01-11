<?php
namespace App\Repositories;
use App\Database\Db;

class UserRepo{
    private $conn;
    public function __construct()
    {
        $database= new DB();
        $this->conn=$database->connect();
    }
    
}
?>