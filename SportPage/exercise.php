<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>


    <link rel="stylesheet" type="text/css" href="../css/htmleaf-demo.css">
    <link rel="stylesheet" href="../css/jquery-pie-loader.css">
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

        .mylabel{
            font-size:40px;
            text-align:left;
            color: #7fb2ff;
            font-family:Helvetica;
            margin-top:-50px;
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
        .insidecontent{
            margin-top:7%;
            margin-left:10%;
            height:100%;
            font-size:25px;
        }
        .insidecontent2{
            margin-right:50px;
            height:800px;
            font-size:25px;
            background-color:#eaf2f2;
            border-radius:10px 10px 10px 10px;
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
            <li><a href="MySport.php">我的运动</a></li>
            <li><a href="#">身体管理</a></li>
            <li><a href="#" style="color:#daddf0; background-color: #80c3f7;">健身追踪</a></li>
            <li><a href="#">睡眠分析</a></li>
        </ul>
    </div>
</div>

<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">健身追踪</div><hr style="margin-right: 50px;">
        <div class="insidecontent2">
            <label style="margin-left:5%; font-family:微软雅黑;font-size:20px;color:#55555c;">运动目标完成</label>

            <div  style="display:inline-block">
                <figure id="pie" name=<?PHP echo 6; ?> data-behavior="pie-chart1" style="margin-right:50px;"></figure>
<label style="font-size:18px;margin-left:-50px;color:#55555c;font-family: 微软雅黑;">运动距离:</label>
                <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">公里</label>
                <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
                <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动时长:</label>
                <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">小时</label>
                <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">分钟</label>
<br>
                <label style="font-size:18px;margin-left:207px;color:#55555c;font-family: 微软雅黑;">燃烧热量:</label>
                <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">大卡</label>
                <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
                <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动步数:</label>
                <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">步</label>


            </div>

           </div>
  </div>


</div>
<script src="../jquery-1.8.3/jquery.js" type="text/javascript"></script>

    <script  src="../js/demo.js"></script>
</script>

<script>window.jQuery || document.write('<script src="../js/jquery-2.1.1.min.js"><\/script>')</script>
<script src="../js/jquery-pie-loader.js"></script>
<script type="text/javascript">
    $(document).ready(function() {


        $('*[data-behavior="pie-chart1"]').each(function() {

            $(this).svgPie({
                percentage: $(this).attr('name')
            });

        });




    });


</script>
<script language="JavaScript">




</script>

</body>


</html>