<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/29
 * Time: 22:37
 */
$str=$_GET['q'];
$arr=explode('-',$str);
$fromidtoid=$arr[0];
$money=$arr[3];
$aftermoney=1-$money;
$exp=$arr[2];
$afterexp=1-$exp;
$toid=$arr[1];
$db=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
$result=$db->query("update report set hascheck='1',approve='1',minusexp='$exp',minusmoney='$money' where fromidtoid='$fromidtoid'");
$result2=$db->query("update users set baseexp=baseexp*'$afterexp',money=money*'$aftermoney' where id='$toid'");
if($result){
    echo "处理成功!";

}else{
    echo '处理失败';
}


