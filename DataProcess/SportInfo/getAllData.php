<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/4
 * Time: 20:44
 */
session_start();
include('../SportInfo/Sport.php');
$id=$_SESSION['userid'];
$dbaddr=
$sport=new Sport($id,'sqlite:../AccountInfo/mydatabase.sqlite');
$data=$sport->getAllData();
$arr=array();
$count=count($data);
for($j=$count-15;$j<$count;$j++){
    array_push($arr,$data[$j]);
}



exit(json_encode($arr));
