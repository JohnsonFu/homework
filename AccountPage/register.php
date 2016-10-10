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
<form name="form1" method="post" action="../dataprocess/regist.php">
<div class="form" align="center">
    <div class="group">
        <div class="group-ipt">
            <input type="text"  name="username" class="ipt" placeholder="用户名" required>
        </div>
        <div class="group-ipt"><input type="text" name="password" name="password" class="ipt" placeholder="设置您的登录密码" required>
      </div>
</div>
    <div align="left">
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
    <button type="submit"  class="login-btn register-btn" id="button">注册</button>
</div>
    </form>
<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>
</body>
</html>

