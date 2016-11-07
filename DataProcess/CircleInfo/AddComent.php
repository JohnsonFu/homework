<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/25
 * Time: 08:18
 */
session_start();
$id=$_SESSION['userid'];
session_write_close();
$toid=$_POST['toid'];
$comment=$_POST['comment'];
if($comment!='') {
    $time = time() + 8 * 60 * 60;
    $date = '20' . date("y-m-d H:i", $time);
    $postid = $_POST['postid'];
    $db = new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
    $result = $db->query("insert into comment(masterid,pid,time,content,toid)values('$id','$postid','$date','$comment','$toid')");
    if ($result == true) {
        echo "<script>alert('评论成功');location.href='../../CirclePage/mycircle.php';</script>";
    } else {
        echo "<script>alert('评论失败');location.href='../../CirclePage/mycircle.php';</script>";
    }
}else{
    echo "<script>alert('评论不得为空');location.href='../../CirclePage/mycircle.php';</script>";
}

