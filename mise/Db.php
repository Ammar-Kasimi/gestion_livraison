<?php


use PDO;
use PDOException;
class Db{
    private $pdo;
    private $user="root";
    private $pass="";
    private $server="localhost";
    private $dbname="mise_OOP";

    public function connect(){
        $this->pdo=new PDO("mysql:host={$this->server};dbname={$this->dbname},{$this->user},{$this->pass}");
        try{
         $this->conn->set_Attribute(PDO::ERRMODE_EXCEPTION,ERRMODE)
        }
        catch(PDOException $e){
            die("connection failed". $e->getMessage());
        }
    }

}
?>