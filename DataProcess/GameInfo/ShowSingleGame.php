<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/11
 * Time: 14:52
 */
session_start();
$str=$_GET['q'];
$arr=explode('-',$str);
$gameid=$arr[1];
$gamename=$arr[0];
$_SESSION['gamename']=$gamename;
$_SESSION['gameid']=$gameid;
Header("Location:../../GamePage/SingleGame.php");

//echo "hello".$gameid;