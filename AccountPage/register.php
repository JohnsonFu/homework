<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
</head>
<body>
<div >
    <div >
        <h1 >爱运动</h1>
        <h2 >生命在于运动 - isport</h2>
    </div>
</div>
<div class="index-slide-nav">
    <a href="../login.html" class="active">登录</a>
    <a href="register.php" class="hover">注册</a>
    <div class="slide-bar slide-bar1"></div>
</div>
<form name="form1" method="post" action="../DataProcess/AccountInfo/regist.php" onsubmit="return check()">
<div class="form" align="center">
    <div class="group">
        <div class="group-ipt email">
            <input type="text"  name="username" class="ipt" placeholder="账号名(6-18位)" required>
        </div>
        <div class="group-ipt password"><input type="text" name="nickname" id="nickname" class="ipt" placeholder="输入您的昵称" required>
        </div>
        <div class="group-ipt password"><input type="text" name="password" id="password" class="ipt" placeholder="输入您的登录密码(由6-18位包含字母和数字的字符组成)" required>
        </div>

</div>
    <div align="left" style="margin-top:20px; margin-bottom:20px;">
        <label>性&nbsp;&nbsp;别:&nbsp;&nbsp;&nbsp;</label>
        <input type="radio" name="sex" value="male" checked>男 <input type="radio" name="sex" value="female">女
    </div>

    <div align="left">
        <label>年&nbsp;&nbsp;龄:&nbsp;&nbsp;&nbsp;</label>
        <select name="age"><?PHP for($s=10;$s<90;$s++){
                ?>
            <option value =<?PHP echo($s) ?>><?PHP echo($s) ?></option>
           <?PHP } ?>
        </select>

        <label style="margin-left:30px;">身&nbsp;&nbsp;高:&nbsp;&nbsp;&nbsp;</label>
        <select name="height"><?PHP for($s=140;$s<220;$s++){
                if($s==170){
                ?>
                <option value =<?PHP echo($s) ?> selected><?PHP echo($s) ?></option>
            <?PHP }else{ ?>
            <option value =<?PHP echo($s) ?> ><?PHP echo($s) ?></option>
            <?PHP }} ?>
        </select>
        <div style="margin-top:20px;">
        <label style="">头&nbsp;&nbsp;像:&nbsp;&nbsp;&nbsp;</label>
        <select  size="1" id="logo" name="logos" onchange="showlogo()"><?PHP for($s=1;$s<21;$s++){
                ?>
                <option value =<?PHP echo($s) ?>><?PHP echo($s) ?></option>
            <?PHP } ?>
        </select>
            <label style="font-size:10px;">&nbsp;&nbsp;(1-10为女性头像,11-20为男性头像)</label>
            </div>
            <img style="margin-left:125px;margin-top:20px" name="img" style="padding-top:30px;" src="../headpics/1.gif" width="50px" height="50px">

    </div>



    </div>

</div>

<div class="button">
    <button type="submit"  class="login-btn register-btn"  id="button">注册</button>
</div>
    </form>
<script language="javascript">
    function check(){
        var name=document.getElementsByName("username")[0].value;
  var reg1 = /[a-zA-Z0-9]{6,18}/;
                     if(!reg1.test(name))
                         {
                             alert("不符合规范的账户名");
                             return false;
                         }
        var password=document.getElementById("password").value;
        var reg2=/[a-zA-Z0-9]{6,18}/;
        if(!reg2.test(password)){
            alert("不符合规范的密码");
            return false;
        }
        var nickname=document.getElementById("nickname").value;
        if(nickname.length==0){
            alert("昵称不得为空");
            return false;
        }

 return true;
    }
    function showlogo(){
        document.images.img.src='../headpics/'+document.getElementById('logo').value.toString()+'.gif';
    }
</script>

</body>
</html>

