<?php

namespace App\Services;

use App\Repositories\UserRepo;

class UserService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new UserRepo();
    }
     public function get_repo(){
        return $this->repo;
    }
}

