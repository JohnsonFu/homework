<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/26
 * Time: 20:48
 */
$info=$_GET['q'];
$arr=explode('-',$info);
$joinerid=$arr[0];
$gameid=$arr[1];
$gamejoinerid=$gameid.$joinerid;
$db = new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$result=$db->query("insert into gamejoiner(gamejoinerid,gameid,joinerid)values('$gamejoinerid','$gameid','$joinerid')");
$res2=$db->query("select * from gamejoiner where joinerid='$joinerid'")->fetchAll();
$count=count($res2);
if($result) {
    echo '参与成功';
}else{
    if($count>0){
        echo '你已经加入了该竞赛';
    }else {
        echo '参与失败';
    }
}