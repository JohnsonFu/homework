<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/29
 * Time: 14:40
 */
$str=$_GET['q'];
$db = new PDO("sqlite:mydatabase.sqlite");
$result=$db->query("update report set hascheck='1' where fromidtoid='$str'");
if($result) {
    echo '举报驳回成功!';
}else{
    echo '举报驳回失败!';
}