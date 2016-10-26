<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 21:57
 */
$info=$_GET['q'];
$arr=explode('-',$info);
$joinerid=$arr[0];
$gameid=$arr[1];
$gamejoinerid=$gameid.$joinerid;
$db = new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$result=$db->query("delete from gamejoiner where gamejoinerid='$gamejoinerid'");

if($result) {
    echo '退出成功';
}else{
   echo '退出失败';
}