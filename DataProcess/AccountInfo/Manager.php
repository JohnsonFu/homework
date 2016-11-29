<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/29
 * Time: 10:50
 */
class Manager
{
    public $id;
    public $db;
    function __construct($id,$dbaddr)
    {
        $this->id=$id;
        $this->db=new PDO($dbaddr);
    }
    public function getUncheckReport(){
        $result=$this->db->query("select * from report where hascheck='0'")->fetchAll();
        return $result;
    }
    public function getCheckReport(){
        $result=$this->db->query("select * from report where hascheck='1' order by rowid desc")->fetchAll();
        return $result;
    }

}