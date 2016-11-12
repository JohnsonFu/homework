<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/19
 * Time: 10:58
 */
session_start();
include('../AccountInfo/Account.php');
$db = new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$name=$_POST['gamename'];
$type=$_POST['type'];
$userid=$_SESSION['userid'];
$account=new Account($userid,"sqlite:../AccountInfo/mydatabase.sqlite");
$mymoney=$account->getMoney();
session_write_close();
$starttime=$_POST['starttime'];
$endtime=$_POST['endtime'];
$money=$_POST['money'];
$description=$_POST['description'];

if($mymoney<$money){
    echo "<script>alert('您的金币不足!');location.href='../../GamePage/SetGame.php';</script></script>";
}else {
    $result = $db->query("insert into game(gamename,starttime,endtime,gametype,joinmoney,description,masterid) values ('$name','$starttime','$endtime','$type','$money','$description','$userid')");
    $gameid = $db->query("select max(id) from game where masterid='$userid'")->fetchAll()[0][0];
    $gamejoinerid = $gameid.$userid;
    $result3 = $db->query("insert into gamejoiner(gamejoinerid,gameid,joinerid)values('$gamejoinerid','$gameid','$userid')");
    $db->query("update users set money=money-'$money' where id='$userid'");
    $db->query("update game set allmoney=allmoney+joinmoney where id='$gameid'");
    if(!$result3){
       echo "<script>alert('插入失败');</script>";
    }
    if ($result) {
        echo "<script>alert('添加成功');location.href='../../GamePage/owngame.php';</script>";
        echo '添加成功';
    } else {
        echo '添加失败';
    }
}