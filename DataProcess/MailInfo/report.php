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
$content=$_POST['content'];
$tittle=$_POST['tittle'];
$time=$_POST['time'];
echo $content;