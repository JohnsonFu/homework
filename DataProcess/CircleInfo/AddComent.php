<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/25
 * Time: 08:18
 */
session_start();
$id=$_SESSION['userid'];
$toid=$_POST['toid'];
$comment=$_POST['comment'];
$time =time()+8*60*60;
$date='20'.date("y-m-d h:i",$time);
$postid=$_POST['postid'];
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$result=$db->query("insert into comment(masterid,pid,time,content,toid)values('$id','$postid','$date','$comment','$toid')");
if($result==true){
    echo '评论插入成功';
}else{
    echo '评论插入失败';
}


