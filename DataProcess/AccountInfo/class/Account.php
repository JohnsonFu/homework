<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/17
 * Time: 22:22
 */
class Account
{
 public $db;
 public $id;
 public $infolist;

function __construct($id){
$this->db= new PDO("sqlite:mydatabase.sqlite");
    $this->id=$id;
$this->infolist=$this->db->query("select * from users where id='$id'")->fetchAll();
}

    


}