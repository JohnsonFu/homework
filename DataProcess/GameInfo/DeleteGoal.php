<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/31
 * Time: 18:46
 */
$uid=$_GET['q'];
$db=new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$result=$db->query("delete from goal where uid='$uid'");
if($result) {
    echo '删除成功';
}else{
    echo '删除失败';
}