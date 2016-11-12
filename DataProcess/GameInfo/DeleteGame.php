<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 22:23
 */
$gameid=$_GET['q'];

$db = new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$joinmoney=$db->query("select joinmoney from game where id='$gameid'")->fetchAll()[0][0];
$res1=$db->query("update users set money=money+'$joinmoney' where id in(select joinerid from gamejoiner where gameid='$gameid')");
$result=$db->query("delete from gamejoiner where gameid='$gameid'");
$res2=$db->query("delete from game where id='$gameid'");
if($result&&$res2) {
    echo '删除成功';
}else{
    echo '删除失败';
}