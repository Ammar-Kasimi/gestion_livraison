<?php

Abstract class  User{
private $id;
protected $name;
protected $password;
protected $logged;
protected $role;



public function getId(){
return $this->id ;
}
public function getName(){
return $this->name ;

}
public function getpass(){
return $this->password ;

}
public function getloggged(){
return $this->logged ;

}
public function setName($name){
$this->name =$name;
}
public function setpass($pass)
{
$this->password =$pass;
}
public function setlogged($logged){
$this->logged =$logged;
}

//3rft bllli protected makhashach setters o getters
}
?>