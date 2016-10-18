<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
<link rel="stylesheet" type="text/css" href="AccountCss.css">
    <script>
        function menuFix(){
            var self=document.getElementById("menu").getElementsByTagName("li");
            for(var i=0;i<self.length;i++){
                self[i].onmouseover=function(){
                    this.className+=(this.className.length>0?" ":"")+"listshow";
                }
                self[i].onmouseout=function(){
                    this.className=this.className.replace("listshow","");
                }
            }
        }
        window.onload=menuFix;
    </script>
</head>
<body>
<?PHP
session_start();
$id=$_SESSION['userid'];
$nickname=$_SESSION['nickname'];
$password=$_SESSION['password'];
$sig=$_SESSION['sig'];
$level=$_SESSION['level'];
$money=$_SESSION['money'];
?>


<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul >
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="../SportPage/sport.html" >运动</a></li>
            <li><a href="#">竞赛</a></li>
            <li><a href="#">俱乐部</a></li>
            <li><a href="#">朋友圈</a></li>
            <li><a href="#" style="color:#9eff9d;">个人账户</a>
            </li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div id="header">个人账户</div>
    <div id="vertmenu">
        <ul>
            <li><a href="#" style=" color: #daddf0; background-color: #80c3f7;">基本信息</a></li>
            <li><a href="#">头像设置</a></li>
        </ul>
    </div>
</div>
<div id="content">
    <form method="POST" action="../DataProcess/AccountInfo/Modify.php" onsubmit="return check()">
    <div class="insidecontent">
        <div class="mylabel">基本信息</div><hr style="margin-right: 50px;">
    <label>用户名&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $id; ?></label><br>
        <label>等&nbsp;&nbsp;&nbsp;&nbsp;级&nbsp;&nbsp;&nbsp;LV<?PHP echo $level; ?></label><br>
        <label>金&nbsp;&nbsp;&nbsp;&nbsp;币&nbsp;&nbsp;&nbsp;<?PHP echo $money; ?>金</label><br>
        <label>昵&nbsp;&nbsp;&nbsp;&nbsp;称&nbsp;&nbsp;&nbsp;</label> <input type="text" class="textview" id="nickname" name="nickname" value=<?PHP echo $nickname; ?>  ><br>
        <label>密&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;&nbsp;</label> <input type="text" class="textview" id="password" name="password" value=<?PHP echo $password; ?>  ><br>
          <label style="vertical-align: top;margin-left:-10px;">个性签名&nbsp;&nbsp;</label><textarea name="sig" style="width:400px;height:50px;padding:5px 5px 5px 5px;  border-radius: 2px 2px 2px 2px;
            font-size:18px;background-color: #f7f7f7;" ><?PHP echo $sig ?></textarea>
               <button type="submit"  class="login-btn register-btn" id="button" style="margin-left:15%;width:70px;">修改</button>
    </div>
        </form>
</div>
<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>

<script language="JavaScript">
function check() {

    var password = document.getElementById("password").value;
    var reg2 = /[a-zA-Z0-9]{6,18}/;
    if (!reg2.test(password)) {
        alert("不符合规范的密码");
        return false;
    }
    var nickname = document.getElementById("nickname").value;
    if (nickname.length == 0) {
        alert("昵称不得为空");
        return false;
    }
    return true;
}

</script>

</body>
</html>