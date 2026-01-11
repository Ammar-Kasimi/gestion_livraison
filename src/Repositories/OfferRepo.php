<?php
namespace App\Repositories;
use App\Database\Db;

class OfferRepo{
    private $conn;
    public function __construct()
    {
        $database= new DB();
        $this->conn=$database->connect();
    }
    
}
?>