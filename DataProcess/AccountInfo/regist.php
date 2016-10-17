<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/10
 * Time: 10:48
 */
$name=$_POST["username"];
$password=$_POST['password'];
$sex=$_POST['sex'];
$age=$_POST['age'];
$nickname=$_POST['nickname'];
$height=$_POST['height'];
$db = new PDO("sqlite:mydatabase.sqlite"); //注意红字部分的路径格式，这样写会报错：new PDO('myDB.sqlite');
if ($db){
    $idcheck=$db->query("select count(*) from users where id='$name'")->fetchAll()[0][0];
    $nickcheck=$db->query("select count(*) from users where nickname='$nickname'")->fetchAll()[0][0];
 //  if($idcheck){
  //     echo "该账户名已被注册";
  // }
   if($idcheck>0){

      echo "账户名".$name."已被注册";


   }
   else if($nickcheck>0){
       echo "昵称".$nickname."已被注册";
   }
   else {
       $result = $db->query("insert into users(id,password,sex,age,nickname,height) values ('$name','$password','$sex','$age','$nickname','$height')");
       if($result){
           echo "注册成功";
       }
       else{
           echo "注册失败";
       }

   }

}else{
    echo 'connect bad';
}




