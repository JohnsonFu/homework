<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 19:45
 */
session_start();
$postid=$_GET['q'];
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$res1=$db->query("delete from post where postid='$postid'");
$res2=$db->query("delete from comment where pid='$postid'");

if($res1==true){
    echo "删除成功!";
}else{
    echo "删除失败!";
}