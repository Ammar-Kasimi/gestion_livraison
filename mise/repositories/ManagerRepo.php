<?php
use App\Db;

class ManagerRepo{
    private $conn;
public function __construct()
{
    $database=new Db();
    $conn=$database->connect();

}
 private function add_book($name,$auteur,$cat,$quantity){
    $stmt=$this->conn->prepare("insert into books(name,auteur,categorie,status,quantity) values (?,?,?,?,?) ");
$stmt->execute([$name,$auteur,$cat,"available",$quantity]);
 }
private function delete_book($name){
    $stmt=$this->conn->prepare("drop from books where name=?");
    $stmt->execute([$name]);
}
private function modify_book($name,$auteur,$cat,$quantity){
$stmt=$this->conn->prepare("Update  books set name=?,auteur=?,categorie=?,quantity=?");
$stmt->execute([$name,$auteur,$cat,$quantity]);

}
}

?>