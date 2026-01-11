<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Services\OrderService;

if (isset($_POST['update_order_btn'])) {

    $items = [];
    if (isset($_POST['items'])) {
        $items = $_POST['items'];
    }

    $service2 = new OrderService();
    $service2->get_repo()->update_order($_POST['order_id'], $_POST['title'], $_POST['address'], $items);
    header("Location: ../entities/client.php");
}
