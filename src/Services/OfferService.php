<?php

namespace App\Services;

use App\Repositories\OfferRepo;

class OfferService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new OfferRepo();
    }
     public function get_repo(){
        return $this->repo;
    }

}
