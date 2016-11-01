<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/28
 * Time: 21:28
 */
session_start();
$id=$_SESSION['userid'];
$nick=$_SESSION['nickname'];
session_write_close();
$postid=$_GET['q'];
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$uidpid=$id.$postid;
$res2=$db->query("delete from thumb where uidpid='$uidpid'");
if($res2){
    $result=$db->query("update post set thumbs=thumbs-1 where postid='$postid'");
    $res=$db->query("select thumbs from post where postid='$postid'")->fetchAll();

        echo '取消成功'.'-'.$res[0][0].'-'.$postid;

}