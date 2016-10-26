<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 22:23
 */
$gameid=$_GET['q'];

$db = new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$result=$db->query("delete from gamejoiner where gameid='$gameid'");
$res2=$db->query("delete from game where id='$gameid'");
if($result&&$res2) {
    echo '删除成功';
}else{
    echo '删除失败';
}