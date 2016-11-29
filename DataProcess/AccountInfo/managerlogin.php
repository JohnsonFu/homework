<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/29
 * Time: 10:04
 */
session_start();
$username=$_POST['username'];
$password=$_POST['password'];

if($username && $password){
    if(login($username,$password)==true){
        $_SESSION['managerid']=$username;
        session_write_close();
        Header("Location:../../manager.php ");

    }else{
        echo "<script>alert('登录失败,请重新登录');location.href='../../manlogin.html';</script>";
    }
}





function login($id,$password){
    $db = new PDO("sqlite:mydatabase.sqlite");
    $result=$db->query("select * from manager where userid='$id' and password='$password'")->fetchAll();

    if($result){

        return true;
    }else{
        return false;
    }

}