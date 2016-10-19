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
    public function getPassword(){
        return $this->infolist['password'];
    }
    public function changeNick($nick){
        $nickcheck=$this->db->query("select count(*) from users where nickname='$nick'")->fetchAll()[0][0];
        if($nickcheck>1){
            return -1;
        }else{
            $res=$this->db->query("update users set nickname='$nick' where id='$this->id'");
            if($res){
                return 1;
            }else{
                return 0;
            }
        }
    }

    public function changePassword($pass){
           $res=$this->db->query("update users set password='$pass' where id='$this->id'");
            if($res){
                return 1;
            }else{
                return 0;
            }
 }
    public function changeSignature($sig){
        $res=$this->db->query("update users set signature='$sig' where id='$this->id'");
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    public function getAllUsers(){
        $res=$this->db->query("select * from users")->fetchAll();
        return $res;
    }

}

