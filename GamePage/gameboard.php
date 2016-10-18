<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
   <link rel="stylesheet" type="text/css" href="gamecss.css">
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
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul>
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="sport.html">运动</a></li>
            <li><a href="#"  style="color:#c3ffa2;">竞赛</a></li>
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
    <div align="center" class="infobar">
        <label>JohnsonFu</label><br>
        <label>战斗等级:</label><br>
        <label style="margin-left:-40px;">胜率:</label><hr>
        <button type="button"  class="login-btn register-btn" id="button" onclick="jump()" style="margin-top:12px;margin-left:0%;width:110px;font-size:20px;">发起竞赛</button>
        <a href="#" style="font-size:18px;">规则介绍</a>
    </div>
    <div id="vertmenu" >
        <ul>
            <li style="margin-top:10px; "><a href="gameboard.php" style="color:#daddf0; background-color: #80c3f7;">竞赛场</a></li>
            <li style="margin-top:10px;"><a href="#">我的竞赛</a></li>
            <li style="margin-top:10px;"><a href="#">战书</a></li>
            <li style="margin-top:10px;"><a href="#">单人PK</a></li>
            <li style="margin-top:10px;"><a href="#">群体PK</a></li>
        </ul>
    </div>

</div>
<div id="content">
    <div class="insidecontent">

        <div class="mylabel">竞赛场</div><hr style="margin-right: 50px;">
        <table  class="mytabel" border="1" cellspacing="0" >
            <tr>
            <td style="width:25%;">名称</td>
            <td>参与人数</td>
            <td>运动类型</td>
            <td style="width:20%;">距离开始时间</td>
            <td style="width:20%;">奖金</td>
        </tr>
<?PHP
for($i=0;$i<10;$i++){
?>
            <tr>
                <td style="width:25%;background-color: #abe2ff" >千里之行始于足下</td>
                <td style="background-color: #eaf2f2">1</td>
                <td style="background-color: #eaf2f2">跑步</td>
                <td style="width:20%;background-color: #eaf2f2">7小时10分7秒</td>
                <td style="width:20%;background-color: #eaf2f2">5000金</td>
            </tr>
<?PHP } ?>
        </table>
        </div>

        </div>
    </div>
<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>
<script language="javascript">
    function jump(){
        window.location.href="SetGame.html";
    }

</script>
</body>
</html>