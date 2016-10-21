<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/21
 * Time: 10:43
 */
include('Account.php');
$value=$_GET['q'];
$arr=explode('__',$value);
$id=$arr[1];
$friendid=$arr[0];
$account=new Account($id,"sqlite:mydatabase.sqlite");
$res=$account->deleteFriend($friendid);