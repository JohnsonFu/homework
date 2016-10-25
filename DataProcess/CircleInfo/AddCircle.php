<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/24
 * Time: 11:54
 */
session_start();
include('Post.php');
$tittle=$_POST['tittle'];
$content=$_POST['content'];
$masterid=$_SESSION['userid'];
$post=new Post($masterid,'sqlite:../AccountInfo/mydatabase.sqlite');
$time =time()+8*60*60;
$date='20'.date("y-m-d H:i",$time);
$res=$post->AddPost($date,$tittle,$content);
if($res==true){
    echo "<script>alert('发布成功');location.href='../../CirclePage/owncircle.php';</script>";
}else{
    echo "<script>alert('发布鼠标');location.href='../../CirclePage/owncircle.php';</script>";
}