<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 19:45
 */

$postid=$_GET['q'];
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
//$db->exec("PRAGMA foreign_keys=ON");
$res2=$db->query("delete from comment where pid='$postid'");
$res1=$db->query("delete from post where postid='$postid'");


if($res1==true){
    echo "删除成功!";
}else{
    echo "删除失败!";
}