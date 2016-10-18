<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>


    <link rel="stylesheet" type="text/css" href="../css/htmleaf-demo.css">
    <link rel="stylesheet" href="../css/jquery-pie-loader.css">
    <link rel="stylesheet" type="text/css" href="SportCss.css">
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
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="sport.html" style="color:#9eff9d;">运动</a></li>
            <li><a href="#">竞赛</a></li>
            <li><a href="#">俱乐部</a></li>
            <li><a href="#">朋友圈</a></li>
            <li><a href="#">个人账户</a></li>
            <li><a href="#">退出登录</a></li>
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