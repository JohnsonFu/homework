<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/10
 * Time: 11:00
 */
session_start();
$username=$_POST['username'];
$password=$_POST['password'];

if($username && $password){
    if(login($username,$password)==true){
        $_SESSION['userid']=$username;
        Header("Location:../../homepage.php ");

    }else{
        echo "<a href='../../login.html'>登录失败!返回</a>";
    }
}





function login($id,$password){
    $db = new PDO("sqlite:mydatabase.sqlite");
    $result=$db->query("select * from users where id='$id' and password='$password'")->fetchAll();

    if($result){

        return true;
    }else{
        return false;
    }

}