<?php

namespace App\Services;
class Menu{

public static function first_menu(){
    echo "Welcome to library manager";
    echo "1.Register";
    echo "2.login";
    echo "3.enter as a guest";
    echo "4.exit";
    $choice=readline();
    switch ($choice) {
        case '1':
           
            break;
        
        default:
            echo "you choice is invalid ,please try again";
            self::first_menu();
            break;
    }
    
}
public static function main_menu(){
    session_start();
    echo "1.see available books";
    echo "2.see books by categorie";
    echo "3.see books by ";
    if($_SESSION["role"]!="member"){
    echo "7.add book";
    echo "8.delete book";
    echo "9.modify book";

    }
    
}
}
?>