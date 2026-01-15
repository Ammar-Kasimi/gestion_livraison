<?php
use App\Db;

class UserRepo{
private $conn;

public function __construct()
{
    $database=new Db();
    $conn=$database->connect();

}

public function show_available(){
$stmt=$this->conn->prepare("select * from livres where status=?");
$stmt->execute(["available"]);
return $result=$stmt->fetchAll();
}
 function show_by_auteur($auteur){
$stmt=$this->conn->prepare("select * from livres where auteurs=?");
$stmt->execute([$auteur]);
return $result=$stmt->fetchAll();
}
public function show_by_cat($cat){
$stmt=$this->conn->prepare("select * from livres where categories=?");
$stmt->execute([$cat]);
return $result=$stmt->fetchAll();
}
public function register($name,$pass){
$stmt=$this->conn->prepare("insert into users(name,password,logged,role) values (?,?,?,?) ");
$stmt->execute([$name,password_hash($pass,Default_hash),"yes","member"]);

}
public function login($email){
$stmt=$this->conn->prepare("select * from user where email=? ");
$stmt->execute([$email]);
$result=$stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>