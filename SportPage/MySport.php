<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />

    <link href="../css/base.css"  rel="stylesheet" type="text/css" />
    <link href="../css/project_base.css"  rel="stylesheet" type="text/css" />
    <link href="../css/radialindicator.css"  rel="stylesheet" type="text/css" />
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
            color: #a6e0ff;
            width:100px;
            text-decoration:none;
            display:block;
            width:100px;
            padding-left:10px;
            border-radius: 10px 10px 10px 10px;
        }

        #vertmenu ul li a:hover{
            color: #daddf0;
            background-color: #555555;
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
    <div id="header">健康管理</div>
    <div id="vertmenu">
        <ul>
            <li><a href="MySport.php" style="color:#daddf0; background-color: #80c3f7;">我的运动</a></li>
            <li><a href="#">身体管理</a></li>
            <li><a href="#">健身追踪</a></li>
            <li><a href="#">睡眠分析</a></li>
        </ul>
    </div>
</div>

<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>
<div id="content">
    <div class="prg-cont rad-prg" id="indicatorContainer2" style="margin-left:100px;">
      <p hidden id="test"><?PHP echo 33; ?></p>
    </div>
<label style="margin-left:100px; font-family:Helvetica;font-size:25px;color:#ffe611;">运动目标完成</label>


</div>


<script type="text/javascript"  src="../js/base.js"></script>
<script type="text/javascript"  src="../js/project_base.js"></script>
<script>
    SyntaxHighlighter.defaults['toolbar'] = false;
    SyntaxHighlighter.all();
</script>

<script src="../js/radialindicator.js"></script>
<script language="JavaScript">



      // var i=document.getElementById("index").value;
var i=document.getElementById("test").innerHTML;
       $('#indicatorContainer2').radialIndicator({

           barColor: '#87CEEB',
           barWidth: 10,
           initValue: i,
           roundCorner: true,
           percentage: true
       });


</script>
<script src="../js/demo.js"></script>
</body>


</html>