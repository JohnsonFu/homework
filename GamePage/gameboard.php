<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
   <link rel="stylesheet" type="text/css" href="gamecss.css">
    <style type="text/css">
        .gameinfo{
            margin-top:20px;
          width:93%;
            align:center;
            height:auto;
            background-color: #ffffff;
            border:1px;
            solid: #000;
        }
        .gameheader{
            background-color: #ececec;
            height:25px;
            font-family:Helvetica;
            color:grey;
            font-size:20px;
        }
        .tablebutton{
            background: #0f88eb;
            box-shadow: none;
            border: 0;
            color: #fff;
            display: block;

            cursor: pointer;
        }
        .tablebutton:hover{
            background: #80c3f7;
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
<div id="content" style="height:auto">
    <div class="insidecontent" style="height:auto">

        <div class="mylabel">竞赛场</div><hr style="margin-right: 50px;">

        <div class="gameinfo" style="border-style:solid; border-width:1px; border-color:#000">
            <div class="gameheader" style="border-bottom-style:solid; border-width:1px; border-color:#000">奔跑吧兄弟  <input type="button" value="退出" class="tablebutton" style=";font-size:20px;width:70px;float:right;height:25px;">
            </div>
            <table  style="font-size:10px;width:100%;text-align:center"  cellspacing="0" >
                <tr style="font-size:13px;">
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">发起者</td>
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">名称</td>
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;">类型</td>
                </tr>
                <tr style="font-size:13px;background-color:#ececec;">
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">蛤蛤酱</td>
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">跑得比谁都快</td>
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;">群体PK</td>
                </tr>
                <tr style="font-size:13px;">
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">人数</td>
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">离竞赛开始还有</td>
                    <td style="border-bottom-style:solid; border-width:1px;border-color:#000;">奖金</td>
                </tr>
                <tr style="font-size:13px;background-color:#ececec;">
                    <td style=" border-width:1px;border-color:#000;border-right-style:solid;">6</td>
                    <td style="border-width:1px;border-color:#000;border-right-style:solid;">1天2小时3分</td>
                    <td style=" border-width:1px;border-color:#000;">1000</td>
                </tr>
            </table>
             </div>


        </div>


    </div>

<script language="javascript">
    function jump(){
        window.location.href="SetGame.php";
    }

</script>
</body>
</html>