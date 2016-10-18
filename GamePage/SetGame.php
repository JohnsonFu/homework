<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
   <link rel="stylesheet" type="text/css" href="gamecss.css">

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
            <li><a href="#">个人账户</a></li>
            <li><a href="#">退出登录</a></li>
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
    <div id="vertmenu">
        <ul>
            <li style="margin-top:10px; "><a href="gameboard.php" >竞赛场</a></li>
            <li style="margin-top:10px;"><a href="#">我的竞赛</a></li>
            <li style="margin-top:10px;"><a href="#">战书</a></li>
            <li style="margin-top:10px;"><a href="#">单人PK</a></li>
            <li style="margin-top:10px;"><a href="#">群体PK</a></li>
        </ul>
    </div>

</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">发起竞赛</div><hr style="margin-right: 50px;">
        <label style="margin-left:-10px;">竞赛名称</label><input type="text" style="margin-left:30px;height:20px;"><br>
        <label style="margin-left:-10px;">运动类型</label>
        <select style="margin-left:30px;width:100px;height:30px;"  name="type">
            <option value="单人PK">单人PK</option>
            <option value="群体PK">群体PK</option>
        </select><br>
        <label style="margin-left:-10px;">开始时间</label><br>
        <label style="margin-left:-10px;">结束时间</label><input type="datetime" value="2014-01-13"/><br>
        <label style="margin-left:-10px;">保&nbsp;证&nbsp;金&nbsp;&nbsp;&nbsp;</label><input type="text" class="textview" placeholder="300" name="count" style="width:60px; margin-left:30px;height:20px;margin-right:20px;"><label style="font-size:15px;">金币</label>
<br>
            <label style="vertical-align: top;margin-left:-10px;">竞赛介绍</label><textarea style="margin-top:5px;margin-left:30px;width:400px;height:50px;padding:5px 5px 5px 5px;  border-radius: 2px 2px 2px 2px;
            font-size:18px;background-color: #f7f7f7;"></textarea>

            <button type="submit"  class="login-btn register-btn" id="button" style="margin-left:67%;width:70px;">建立竞赛</button>

        </div>

</div>


<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>

</body>
</html>