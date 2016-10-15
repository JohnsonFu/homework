<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../cssown/logregis.css"/>
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
<form name="form1" method="post" action="../dataprocess/regist.php" onsubmit="return check()">
<div class="form" align="center">
    <div class="group">
        <div class="group-ipt email">
            <input type="text"  name="username" class="ipt" placeholder="账号名(6-12位)" required>
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
  var reg1 = /[a-zA-Z0-9]{6,12}/;
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
</script>
<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>
</body>
</html>

