<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../cssown/logregis.css"/>
    <style type="text/css">
        body{
            background-color: #eaf2f2;
        }
        #menu ul{
            magrin-top:0;
            padding:0;
            list-style-type: none;
            margin-left: 30%;
            margin-bottom:-18px;
        }
        #menu li{
            float:left;
            font-family:Helvetica;
            margin-right: 20px;
            font-size:22px;
            color: #ffffff;
        }
        #menu ul li a{
            color: #ffffff;
            width:100px;
            text-decoration:none;
            display:block;
            position:relative;

        }
        #menu ul li a:hover{
            color: #e7ecff;
        }
        #menu ul li ul{
            display:none;
        }
        #menu ul li.listshow ul{
            display:block;
        }
        #menu ul li ul li {

            float:none;
            margin-left:-30px;

        }

        #menu ul li ul li a{
            color: #daddf0;
        }

        #vertmenu ul{
            margin-top:20px;
            padding:0;
            list-style-type: none;
            margin-left: 30%;
        }
        #vertmenu ul li {
            margin-top:25px;
            float:none;
            font-family:Helvetica;
            margin-right: 20px;
            font-size:22px;

        }
        #vertmenu ul li a{
            color: #a3cfff;
            width:100px;
            text-decoration:none;
            display:block;
            width:100px;
            padding-left:10px;
            border-radius: 10px 10px 10px 10px;
        }

        #vertmenu ul li a:hover{
            color: #daddf0;
            background-color: #abe2ff;
        }
        #header{
            font-family:Helvetica;
            margin-left: 100px;
            margin-top:30px;
            font-size:30px;
            color: rgba(95, 91, 94, 0.98);
        }

        #top_bg{
            height:40px;
            top:0;
            width:100%;
            background: #b3ccff;
            box-shadow:1px 1px 7px #999;
            position:fixed;
            z-index:999;
            left:0;
            border-bottom:#C6C6C6 solid 1px;
        }
        #leftbar{
            height:100%;
            top:50px;
            width:30%;
            background-color: #eaf2f2;
            position:fixed;
            left:0;
        }
        #content{
            left:30%;
            height:100%;
            top:45px;
            background-color: #ffffff;
            position:fixed;
            width:60%;

            border-radius:40px 40px 40px 40px;
        }
        #splitbar{
            width:100%;
            height:10px;
            background-color: #eaf2f2;
            top:45px;
        }
        .logo_l{
            width:145px;
            height:40px;
            float:left;
            background:url(../logo.png) no-repeat left;
        }
        .footer{
            margin-top:45%;
            width: 100%;
            height: 40px;
            bottom: 0;
            left: 0;
            text-align: center;
            color: #999;
            z-index: 2;
            padding-bottom: 10px;
            font-size: 10px;
        }
        .infobar{
            font-size:20px;margin-left:27%;color:#55555c;
            width:150px;


        }
        .infobar label{
            margin-top:25px;
            float:none;
            font-family:Helvetica;
            font-size:22px;
        }
        .mylabel{
            font-size:40px;
            text-align:left;
            color: #7fb2ff;
            font-family:Helvetica;
            margin-top:-50px;
        }
        .insidecontent{
            margin-top:7%;
            margin-left:10%;
            height:100%;
            font-size:25px;
        }
        .mytabel{
            margin-top:20px;
            align:center;
            width:93%;
            font-size:15px;
        }
        .mytabel tr{
            text-align:center;

        }

    </style>
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
            <li><a href="../homepage.html">首页</a></li>
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
    <div id="vertmenu">
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