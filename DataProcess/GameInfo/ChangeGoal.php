<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/31
 * Time: 10:43
 */
session_start();
$uid=$_SESSION['userid'];
$cycle=$_POST['cycle'];
$type=$_POST['type1'];
$time =time()+32*60*60;
$date='20'.date("y-m-d",$time);
$nums;
$db=new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
if($type=='distance'){
    $nums=$_POST['type2'];
    echo $uid."-".$cycle."-".$type.'-'.$nums.'-'.$date;
}if($type=='walk'){
    $nums=$_POST['type3'];
    echo $uid."-".$cycle."-".$type.'-'.$nums.'-'.$date;
}

$result=$db->query("insert into goal(uid,time,type,nums,cycle,bonus) values ('$uid','$date','$type','$nums','$cycle','500')");
if($result){
    echo '目标设定成功';
}else{
    echo '目标设定失败';
}