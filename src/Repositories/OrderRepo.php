<?php

namespace App\Repositories;

use App\Database\Db;
use PDO;

class OrderRepo
{
    private $conn;
    public function __construct()
    {
        $database = new DB();
        $this->conn = $database->connect();
    }
    public function get_order_items($id)
    {
        $stmt = $this->conn->prepare("select * from items where order_id=? ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // public function save_order()
    // {
    //     $stmt = $this->conn->prepare("select * from items where order_id=? ");
    //     $stmt->execute([$id]);
    // }
    public function update_order($id, $title, $address, $items)
    {


        $stmt1 = $this->conn->prepare("UPDATE orders SET title = ?, address = ? WHERE id = ?");
        $stmt1->execute([$title, $address, $id]);


        $stmt2 = $this->conn->prepare("DELETE FROM items WHERE order_id = ?");
        $stmt2->execute([$id]);
        $stmt3 = $this->conn->prepare("INSERT INTO items (name, order_id) VALUES (?, ?)");

        foreach ($items as $item) {
            $stmt3->execute([$item, $id]);
        }
    }
}
