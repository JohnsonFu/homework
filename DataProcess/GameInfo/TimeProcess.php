<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/27
 * Time: 15:05
 */

function getTimeMinus($startdate,$enddate){
    $time =time()+8*60*60;
    $nowdate='20'.date("y-m-d H:i",$time);
    if(strtotime($nowdate)<=strtotime($startdate)) {
        $date = floor((strtotime($startdate) - strtotime($nowdate)) / 86400);
        $hour = floor((strtotime($startdate) - strtotime($nowdate)) % 86400 / 3600);
        $minute = floor((strtotime($startdate) - strtotime($nowdate)) % 86400 / 60);
        $minute=$minute-$hour*60;
        return '离竞赛开始还有'.$date . "天".$hour . "小时".$minute . "分钟";
    }
    if(strtotime($nowdate)>strtotime($startdate)&&strtotime($nowdate)<strtotime($enddate)){
        $date = floor((strtotime($enddate) - strtotime($nowdate)) / 86400);
        $hour = floor((strtotime($enddate) - strtotime($nowdate)) % 86400 / 3600);
        $minute = floor((strtotime($enddate) - strtotime($nowdate)) % 86400 / 60);
        $minute=$minute-$hour*60;
        return '离竞赛结束还有'.$date . "天".$hour . "小时".$minute . "分钟";
    }
    if(strtotime($nowdate)>=strtotime($enddate)){
        $date = floor((strtotime($nowdate) - strtotime($enddate)) / 86400);
        $hour = floor((strtotime($nowdate) - strtotime($enddate)) % 86400 / 3600);
        $minute = floor((strtotime($nowdate) - strtotime($enddate)) % 86400 / 60);
        $minute=$minute-$hour*60;
        return '竞赛已经结束了'.$date . "天".$hour . "小时".$minute . "分钟";
    }
    else{
        return "";
    }
}

