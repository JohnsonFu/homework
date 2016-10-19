<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/19
 * Time: 18:17
 */
class mygame
{
public $id;

    private $owngame;
    public $joingame;
    public $db;
    public $allgame;
    function __construct($addr,$id)
    {
        $this->db=new PDO($addr);
        $this->id=$id;
    }
     function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db=null;
    }
    public function getowngame(){
      $result=$this->db->query("select * from game where masterid='$this->id'");
        if($result){
            return $result->fetchAll();
        }else{
            return null;
        }
    }
    public function getjoingame(){

    }
}

