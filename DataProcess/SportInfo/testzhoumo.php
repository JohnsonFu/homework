<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/5
 * Time: 10:17
 */
$time =time()+32*60*60;
$date='20'.date("y-m-d",$time);
if((date('w',strtotime($date))==6) || (date('w',strtotime($date)) == 0)){
    echo '你输入的日期是周末';
}else{
    echo '当然也不是周末了';
}