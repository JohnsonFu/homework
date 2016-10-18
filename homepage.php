<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="logregis.css"/>
    <link rel="stylesheet" type="text/css" href="GamePage/gamecss.css">
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
<?PHP session_start();
include('DataProcess/AccountInfo/Account.php');
$id=$_SESSION['userid'];
$dbaddr="sqlite:DataProcess/AccountInfo/mydatabase.sqlite";
$account= new Account($id,$dbaddr);
$nickname=$account->getNick();
$level=$account->getLevel();
$money=$account->getMoney();
$sig=$account->getSig();
?>
<body>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul >
            <li><a href="../homepage.html">首页</a></li>
            <li><a href="sport.html" style="color:#9eff9d;">运动</a></li>
            <li><a href="#">竞赛</a></li>
            <li><a href="#">俱乐部</a></li>
            <li><a href="#">朋友圈</a></li>
            <li><a href="#">个人账户</a>
                <ul>
                    <li><a href="../AccountPage/personinfo.html">个人设置</a></li>
                    <li><a href="../AccountPage/friend.html">我的好友</a></li>
                    <li><a href="#">退出登录</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div align="center" class="infobar" >
        <label>用户名:<?PHP echo $nickname ?></label><br>
        <label style="margin-left:-40px;">等级:Level<?PHP echo $level ?></label><br>
        <label style="margin-left:-40px;">胜率:</label><br>
        <label>我的金币:<?PHP echo $money ?></label>
        <label>个性签名:<?PHP echo $sig ?></label>



        <hr>
    </div>
    <div id="vertmenu">
        <ul>
            <li style="margin-top:10px;"><a href="gameboard.php">我的好友</a></li>
            <li style="margin-top:10px;"><a href="#">我的活动</a></li>
            <li style="margin-top:10px;"><a href="#">战书</a></li>
            <li style="margin-top:10px;"><a href="#">单人PK</a></li>
            <li style="margin-top:10px;"><a href="#">群体PK</a></li>
        </ul>
    </div>
</div>

<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>
<div id="content"></div>
</body>
</html>>