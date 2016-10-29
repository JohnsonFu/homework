<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/29
 * Time: 18:36
 */
$info=$_GET['q'];
$arr=explode('-',$info);
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$mid=$arr[0];
$fid=$arr[1];
$tid=$arr[2];
$contents=$arr[3];
$time =time()+8*60*60;
$date='20'.date("y-m-d H:i",$time);
$result=$db->query("insert into replymail(mid,fid,tid,time,contents)values('$mid','$fid','$tid','$date','$contents') ");
if($result){
    echo '回复成功!';
}
else{
    echo '回复失败!';
}