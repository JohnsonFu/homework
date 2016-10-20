<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/20
 * Time: 19:55
 */
$value=$_GET['q'];
$arr=explode('__',$value);
$id=$arr[1];
$friendid=$arr[0];
$db=new PDO("sqlite:mydatabase.sqlite");
if($id==$friendid){
    echo '不能添加自己为好友';
}
else{
    $res=$db->query("select * from friend where id='$id' and friendid='$friendid'")->fetchAll();
    if(count($res)>0){
        echo '你已经添加过该用户为好友';
    }else {
        $result = $db->query("insert into friend(id,friendid) values ('$id','$friendid') ");
        if ($result) {
            echo '好友添加成功!';
        } else {
            echo '好友添加失败!';
        }
    }
}