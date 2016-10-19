<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/19
 * Time: 10:58
 */
session_start();
$db = new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$name=$_POST['gamename'];
$type=$_POST['type'];
$userid=$_SESSION['userid'];
$starttime=$_POST['starttime'];
$endtime=$_POST['endtime'];
$money=$_POST['money'];
$description=$_POST['description'];
$result=$db->query("insert into game(gamename,starttime,endtime,gametype,joinmoney,description,masterid) values ('$name','$starttime','$endtime','$type','$money','$description','$userid')");

if($result){
    echo '添加成功';
}
else{
    echo '添加失败';
}