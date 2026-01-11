<?php

namespace App\Classes;

use App\Database\Db;



class Order
{ 
    protected $id;
    public $title;
    public $status; 
    public $address;
    public $user_id;
    public $items=[];
    public $conn;

    public function __construct()
    {
        $database = new Db();
        $this->conn = $database->connect();
       
       
    }
    public function fill_order($user_id,$title,$address){
        $this->title = $title;
        $this->status = "en attente";
        $this->address=$address;
        $this->user_id=$user_id;
    }
   private function addobject($obj){
        array_push($this->items,$obj);
    }
    // public function create_order($title,$address,$items) {

    public function insert_order($user_id,$title,$address){
        $stmt= $this->conn->prepare("insert into orders(user_id,title,status,address) values(?,?,?,?)");
       $stmt->execute([$user_id,$title,$this->status,$address]);
       $this->id=$this->conn->lastInsertId();
    }
    public function get_order_id(){
        return $this->id;
    }
    // }

    public function cancel_order($Id) {}

    public function modify_order($Id, $data) {}

    public function delete_order($Id) {}

    public function show_order_details($Id) {}
    public function fetch_order($id){
        $stmt=$this->conn->prepare("select * from orders where id =?");
        $stmt->execute([$id]);
        $result=$stmt->fetch();
        $this->id=$result["id"];
        $this->title= $result["title"];
        $this->status=$result["status"];
        $this->address=$result["address"];
        $this->user_id=$result["user_id"];

    }

    public function show_inactive_orders() {}
}
