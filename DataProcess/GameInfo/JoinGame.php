<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 20:48
 */
include('../AccountInfo/Account.php');
$info=$_GET['q'];
$arr=explode('-',$info);
$joinerid=$arr[0];
$gameid=$arr[1];
$gamejoinerid=$gameid.$joinerid;
$db = new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$account=new Account($joinerid,"sqlite:../AccountInfo/mydatabase.sqlite");
$mymoney=$account->getMoney();
$joinmoney=$db->query("select * from game where id='$gameid' ")->fetchAll()[0]['joinmoney'];
if($mymoney<$joinmoney){
    echo '您的金币不足,不能参加该竞赛';
}else {
    $result = $db->query("insert into gamejoiner(gamejoinerid,gameid,joinerid)values('$gamejoinerid','$gameid','$joinerid')");
    $db->query("update users set money=money-'$joinmoney' where id='$joinerid'");
    $db->query("update game set allmoney=allmoney+joinmoney where id='$gameid'");
    $res2 = $db->query("select * from gamejoiner where joinerid='$joinerid'")->fetchAll();
    $count = count($res2);
    if ($result) {
        echo '参与成功';
    } else {
        echo '参与失败';
    }
}