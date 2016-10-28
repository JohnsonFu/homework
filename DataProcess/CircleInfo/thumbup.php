<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 16:47
 */
session_start();
$id=$_SESSION['userid'];
$nick=$_SESSION['nickname'];
$postid=$_GET['q'];
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$uidpid=$id.$postid;
$res2=$db->query("insert into thumb(pid,uid,uidpid,nick) values ('$postid','$id','$uidpid','$nick')");
if($res2){
    $result=$db->query("update post set thumbs=thumbs+1 where postid='$postid'");
    $res=$db->query("select thumbs from post where postid='$postid'")->fetchAll();
    if($result)
        echo '点赞成功'.'-'.$res[0][0].'-'.$postid;
    else{
        echo '点赞失败';
    }
}
