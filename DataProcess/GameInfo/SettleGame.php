<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/12
 * Time: 20:25
 */
include('../GameInfo/mygame.php');

$info=$_GET['q'];
$arr=explode('-',$info);
$gameid=$arr[0];
$userid=$arr[1];
$mygame=new mygame('sqlite:../AccountInfo/mydatabase.sqlite',$userid);
$ranklist=$mygame->getJoinerRankInfo($gameid);
$game=$mygame->getGame($gameid);
$starttime=cuttime($game['starttime']);
$endtime=cuttime($game['endtime']);
$joinmoney=$game['joinmoney'];
settle($ranklist,$joinmoney,$gameid,$starttime,$endtime);
echo '结算成功!';

function settle($list,$singlemoney,$gameid,$s,$e){
    $db=new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
      $count=count($list);
    $rank=1;
    foreach($list as $item){
        $id=$item['id'];
        $masternick=$item['owner'];
       $winmoney=round(2*($count-$rank+1)/($count+1)*$singlemoney*1.2,1);
       $gameidyourid=$gameid.$id;
        $db->query("update users set money=money+'$winmoney'where id='$id'");
 $db->query("insert into gameresult(gameid,nick,id,count,rank,money,gameidyourid,start,end) values ('$gameid','$masternick','$id','$count','$rank','$winmoney','$gameidyourid','$s','$e')");

        $rank++;

    }
    $db->query("update game set issettle=1 where id='$gameid'");
}
function cuttime($time){
    $arr=explode("-",$time);
    return $arr[1].'-'.$arr[2];

}

