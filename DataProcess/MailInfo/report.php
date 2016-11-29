<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/28
 * Time: 23:33
 */
session_start();
$fid=$_SESSION['userid'];
session_write_close();
$tid=$_POST['toid'];
$fromidtoid=$fid.$tid;
$content=$_POST['content'];
$time=$_POST['time'];
if($fid==$tid){
    echo "不能举报自己!";
}
else {
    $db = new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
    $count = count($db->query("select * from report where fromidtoid='$fromidtoid'")->fetchAll());
    if ($count > 0) {
        echo "您已经举报过该用户!";
}else {
        $result = $db->query("insert into report(fromidtoid,fromid,toid,reason,time) values ('$fromidtoid','$fid','$tid','$content','$time')");
if($result){
    echo "举报成功!";
}else{
    echo "举报失败!";
}

    }
}