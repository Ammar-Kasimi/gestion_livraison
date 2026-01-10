<?php
namespace App\Classes;

use App\Database\Db;

class Item {
    private $id;
    protected $name;
    protected $order_id;
    protected $conn;
  public function __construct($name,$order_id){
   $database = new Db;
     $this->conn = $database->connect();
     $this->name=$name;
     $this->order_id=$order_id;
  }
  public function insert_item(){
     $stmt= $this->conn->prepare("insert into items(order_id,name) values(?,?)");
       $stmt->execute([$this->order_id,$this->name]);
       $this->id=$this->conn->lastInsertId();
  }
  public function get_item_id(){
    return $this->id;
  }
}

