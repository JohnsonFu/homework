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
                <ul>
                    <li><a href="#">个人设置</a></li>
                    <li><a href="../AccountPage/friend.html">我的好友</a></li>
                    <li><a href="#">退出登录</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div id="header">个人设置</div>
    <div id="vertmenu">
        <ul>
            <li><a href="#" style=" color: #daddf0; background-color: #80c3f7;">基本信息</a></li>
            <li><a href="#">头像设置</a></li>
        </ul>
    </div>
</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">基本信息</div><hr style="margin-right: 50px;">
    <label>用户名&nbsp;&nbsp;&nbsp;&nbsp;JohnsonFu</label><br>
        <label>昵&nbsp;&nbsp;&nbsp;&nbsp;称&nbsp;&nbsp;&nbsp;</label> <input type="text" class="textview" placeholder="华哥" name="nickname" ><br>
    <label>密&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;&nbsp;</label> <input type="text" class="textview" placeholder="mangguo" name="password" ><br>
          <label style="vertical-align: top;margin-left:-10px;">个性签名&nbsp;&nbsp;</label><textarea style="width:400px;height:50px;padding:5px 5px 5px 5px;  border-radius: 2px 2px 2px 2px;
            font-size:18px;background-color: #f7f7f7;" ></textarea>
               <button type="submit"  class="login-btn register-btn" id="button" style="margin-left:15%;width:70px;">保存</button>

    </div>
</div>
<div class="footer">
    <p>爱运动 - isport</p>
    <p>Designed By FuLinhua 2016</p>
</div>

</body>
</html>