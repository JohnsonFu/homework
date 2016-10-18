<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/18
 * Time: 11:34
 */
session_start();
$id=$_SESSION['userid'];
include('Account.php');
$addr="sqlite:mydatabase.sqlite";
$account=new Account($id,$addr);
$nickname=$_POST['nickname'];
$password=$_POST['password'];
$sig=$_POST['sig'];


$res1=$account->changeNick($nickname);
$res2=$account->changePassword($password);
$res3=$account->changeSignature($sig);

if($res1==1&&$res2==1){
    $_SESSION['nickname']=$nickname;
    $_SESSION['password']=$password;
   $_SESSION['sig']=$sig;
    echo "<script>alert('修改成功!');</script>";

}else {
    if ($res1 == -1) {
        echo "<script>alert('已存在的昵称!');</script>";

    }
    if ($res1 == 0) {
        echo "<script>alert('昵称修改失败!');</script>";
    }



    if ($res2 == 0) {
        echo "<script>alert('密码修改失败!');</script>";
    }

}
//Header("Location:../../AccountPage/personinfo.php ");

echo "<meta http-equiv='Refresh' content='0;URL=../../AccountPage/personinfo.php'>";
