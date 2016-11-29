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
$picid=$_POST['logos'];
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
     //  echo "账户名".$name."已被注册";
       echo "<script>alert('账户名已被注册');location.href='../../AccountPage/register.php';</script>";
}
   else if($nickcheck>0){
       echo "<script>alert('昵称名已被注册');location.href='../../AccountPage/register.php';</script>";
   }
   else {
       $result = $db->query("insert into users(id,password,sex,age,nickname,height,picid) values ('$name','$password','$sex','$age','$nickname','$height','$picid')");
       if($result){
           echo "<script>alert('注册成功,请重新登录');location.href='../../login.html';</script>";
       }
       else{
           echo "<script>alert('注册失败,请重新注册');location.href='../../AccountPage/register.php';</script>";
       }

   }

}else{
    echo 'connect bad';
}




