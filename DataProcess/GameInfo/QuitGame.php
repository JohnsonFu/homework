<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 21:57
 */
include('../AccountInfo/Account.php');
$info=$_GET['q'];
$arr=explode('-',$info);
$joinerid=$arr[0];
$gameid=$arr[1];
$gamejoinerid=$gameid.$joinerid;
$db = new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$account=new Account($joinerid,"sqlite:../AccountInfo/mydatabase.sqlite");
$joinmoney=$db->query("select * from game where id='$gameid' ")->fetchAll()[0]['joinmoney'];
$mymoney=$account->getMoney();
$result=$db->query("delete from gamejoiner where gamejoinerid='$gamejoinerid'");
$db->query("update users set money=money+'$joinmoney' where id='$joinerid'");
$db->query("update game set allmoney=allmoney-joinmoney where id='$gameid'");
if($result) {
    echo '退出成功';
}else{
   echo '退出失败';
}