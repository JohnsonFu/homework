<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/9
 * Time: 19:17
 */

$db=new PDO("sqlite:../AccountInfo/mydatabase.sqlite");
$users=$db->query("select * from 'users'")->fetchAll();
$arr=array();
foreach($users as $item){
    $tablename=$item['id'].'data';
    $name=$item['nickname'];
    $pic=$item['picid'];
    $result=$db->query("select * from '$tablename'");
    if($result){
        $totalkm=$db->query("select sum(km) from '$tablename'")->fetchAll()[0][0];
        $totalpath=$db->query("select sum(path) from '$tablename'")->fetchAll()[0][0];
        $single['nick']=$name;
        $single['picid']=$pic;
        $single['km']=$totalkm;
        $single['path']=$totalpath;
        array_push($arr,$single);
    }
    else{

    }
}

function array_sort($arr,$keys,$type){
    $keysvalue = $new_array = array();
    foreach ($arr as $k=>$v){
        $keysvalue[$k] = $v[$keys];
    }
    if($type=='s') {
        asort($keysvalue);
    }
    if($type=='j') {
        reset($keysvalue);
    }
    foreach ($keysvalue as $k=>$v){
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}

$arr2=array_sort($arr,'path','s');
print_r($arr2);


