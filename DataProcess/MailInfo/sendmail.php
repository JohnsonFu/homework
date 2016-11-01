<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/29
 * Time: 16:08
 */
session_start();
$fid=$_SESSION['userid'];
session_write_close();
$tid=$_POST['toid'];
$content=$_POST['content'];
$tittle=$_POST['tittle'];
$time=$_POST['time'];
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$result=$db->query("insert into mail(fid,tid,time,contents,tittle)values('$fid','$tid','$time','$content','$tittle')");
if($result){
    echo '发送成功';
}
else {
    echo '发送失败';
}