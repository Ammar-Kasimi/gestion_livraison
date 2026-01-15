<?php

use App\classes\UserRepo;
namespace App\Services;
class UserService
{

    private $repo = new UserRepo;
    private $data;


    private function logggin($pass)
    {
        $this->data = $this->repo->login($pass);
        if ($this->data) {
            if (password_verify($this->data["password"], $pass)) {
                session_start();
                $_SESSION["id"]=$this->data["id"];
                $session["role"]="member";
            }else{
                echo"wrong password try again"
            }
        }
        else{
            echo "this user doesnt exist";

        }
    }
    private function reggister(){
        $this->repo->register();
        
    }
    private function show_available(){
        $this->repo->show_available();
    }
    private function show_by_cat(){
        $this->repo->show_by_cat
    }
}
