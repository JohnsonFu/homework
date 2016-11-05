<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/31
 * Time: 10:43
 */
session_start();
$uid=$_SESSION['userid'];
session_write_close();
$type=$_POST['type1'];
$time =time()+32*60*60;
$date='20'.date("y-m-d",$time);
$nums;
$db=new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
if($type=='distance'){
    $nums=$_POST['type2'];

}if($type=='walk'){
    $nums=$_POST['type3'];
}
$result1=$db->query("select * from goal where uid='$uid'")->fetchAll();
$count=count($result1);
if($count>0){
    $result3=$db->query("update  goal  set time='$date' , type='$type' , nums='$nums' where uid='$uid' ");
    if($result3){
        echo "<script>alert('目标修改成功');location.href='../../SportPage/SetGoal.php';</script>";
    }else{
        echo "<script>alert('目标修改失败');location.href='../../SportPage/SetGoal.php';</script>";
    }
}else{
    $result=$db->query("insert into goal(uid,time,type,nums,bonus) values ('$uid','$date','$type','$nums','500')");
    if($result){
        echo "<script>alert('目标设定成功');location.href='../../SportPage/SetGoal.php';</script>";
    }else{
        echo "<script>alert('目标设定失败');location.href='../../SportPage/SetGoal.php';</script>";
    }
}

