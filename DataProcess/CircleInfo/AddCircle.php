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
$date='20'.date("y-m-d h:i",$time);
$res=$post->AddPost($date,$tittle,$content);
if($res==true){
    echo '插入成功';
}else{
    echo '插入失败';
}