<?php

namespace App\Services;

use App\Repositories\OrderRepo;

class OrderService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new OrderRepo();
    }
    public function get_repo(){
        return $this->repo;
    }
}
