<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/29
 * Time: 23:34
 */
include('../AccountInfo/Account.php');
$str=$_GET['q'];
$arr=explode('-',$str);
$gameid=$arr[0];
$uid=$arr[1];
$gamejoinerid=$gameid.$uid;
$db=new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$result=$db->query("select * from game where id='$gameid'")->fetchAll()[0];

$count=count($db->query("select * from gamejoiner where gameid='$gameid'")->fetchAll());

if($result['gametype']=='单人PK'and $count==2){
    echo '该竞赛人数已满!';
}
else{
    $account=new Account($uid,"sqlite:../AccountInfo/mydatabase.sqlite");
    $mymoney=$account->getMoney();
    $joinmoney=$db->query("select * from game where id='$gameid' ")->fetchAll()[0]['joinmoney'];

    if($mymoney<$joinmoney){
        echo '被邀请者金币不足,不能参加该竞赛';
    }else {
        $result = $db->query("insert into gamejoiner(gamejoinerid,gameid,joinerid)values('$gamejoinerid','$gameid','$uid')");
        $db->query("update users set money=money-'$joinmoney' where id='$uid'");
        $db->query("update game set allmoney=allmoney+joinmoney where id='$gameid'");
        $res2 = $db->query("select * from gamejoiner where joinerid='$uid'")->fetchAll();
        $count = count($res2);
        if ($result) {
            echo '邀请成功';
        } else {
            echo '邀请失败';
        }
    }
}
