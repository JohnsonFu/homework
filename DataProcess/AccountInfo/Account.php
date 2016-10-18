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

 public function __construct($id,$dbadd){

$this->db= new PDO($dbadd);
    $this->id=$id;
$this->infolist=$this->db->query("select * from users where id='$this->id'")->fetchAll()[0];

}
  public  function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db=null;
    }
  public  function getNick(){
        return $this->infolist['nickname'];
    }

  public  function getLevel(){
        return $this->infolist['level'];
    }
  public  function getMoney(){
        return $this->infolist['money'];
    }
  public  function getSig(){
        return $this->infolist['signature'];
    }

}

