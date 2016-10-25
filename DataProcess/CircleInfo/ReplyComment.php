<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/25
 * Time: 15:20
 */
session_start();
$id=$_SESSION['userid'];
$str=$_GET['q'];
$arr=explode('-',$str);
$comment=$arr[1];
$toid=$arr[0];
$postid=$arr[2];

$time =time()+8*60*60;
$date='20'.date("y-m-d h:i",$time);
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$result=$db->query("insert into comment(masterid,pid,time,content,toid)values('$id','$postid','$date','$comment','$toid')");
if($result==true){
    echo '评论成功';
}else{
    echo '评论失败';
}

