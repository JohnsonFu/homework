<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 16:47
 */
session_start();
$id=$_SESSION['userid'];
$postid=$_GET['q'];

$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$result=$db->query("update post set thumbs=thumbs+1 where postid='$postid'");
$res=$db->query("select thumbs from post where postid='$postid'")->fetchAll();
if($result)
    echo '点赞成功'.'-'.$res[0][0].'-'.$postid;
else{
    echo '点赞失败';
}