<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
    <link rel="stylesheet" type="text/css" href="../GamePage/gamecss.css">
    <link rel="stylesheet" type="text/css" href="../jQuery多功能日期时间插件DateTimePicker/jquery.datetimepicker.css">
    <script src="../jQuery多功能日期时间插件DateTimePicker/jquery.js"></script>
    <script src="../jQuery多功能日期时间插件DateTimePicker/jquery.datetimepicker.js"></script>
<body>
<?PHP
session_start();
if(!isset($_SESSION['userid'])){
    echo "<script>alert('未登录!将返回登录界面....');</script>";
    echo "<meta http-equiv='Refresh' content='0;URL=../login.html'>";
}else{
    $id=$_SESSION['userid'];
    include('../DataProcess/AccountInfo/Account.php');
    $account=new Account($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');

    $list=$account->getMyFollowPosts();
}
session_write_close();
?>
<div id="top_bg">
            <div class="logo_l"></div>
            <div id="menu">
            <ul>
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="../SportPage/MySport.php">运动</a></li>
            <li><a href="gameboard.php" >竞赛</a></li>
            <li><a href="../AccountPage/friend.php">社交</a></li>
            <li><a href="../CirclePage/mycircle.php"  style="color:#c3ffa2;">朋友圈</a></li>
            <li><a href="../AccountPage/personinfo.php">个人账户</a></li>
            <li><a href="../DataProcess/AccountInfo/Logout.php">退出登录</a></li>
            </ul>
            </div>
            </div>
    <div id="leftbar">
        <img style="margin-left:32%;" src="../headpics/<?PHP echo($account->getPicId()); ?>.gif"><br>
        <label style="margin-left:36%;"><?PHP echo($account->getNick()); ?></label>
        <div id="header" style="margin-left:33%;">朋友圈</div>
        <button type="button"  style="margin-left:33%;"  class="login-btn register-btn" id="button" onclick="jump()" style="margin-top:12px;margin-left:0%;width:110px;font-size:20px;">发布状态</button>
        <div id="vertmenu">
            <ul>
                <li><a href="mycircle.php" style="font-size:19px;">关注者动态</a></li>
            </ul>
        </div>
    </div>
            <div id="content">
            <div class="insidecontent">
            <div class="mylabel">发布状态</div><hr style="margin-right: 50px;">
            <form method="post" action="../DataProcess/CircleInfo/AddCircle.php">
            <div style="margin-left:20px;">
            <label style="margin-left:-10px;">状态名称</label><input name="tittle" type="text" style="margin-left:20px;height:20px;font-family:Helvetica;font-size:15px;"><br>

            <label style="vertical-align: top;margin-left:-10px;">内&nbsp;&nbsp;&nbsp;&nbsp;容</label><textarea name="content" style="margin-top:5px;margin-left:30px;width:400px;height:50px;padding:5px 5px 5px 5px;  border-radius: 2px 2px 2px 2px;
    font-size:18px;background-color: #f7f7f7;"></textarea>
    <button type="submit"  class="login-btn register-btn" id="button" style="margin-left:69%;width:70px;">发布</button>
    </div>
    </form>
    </div>

    </div>



</body>
</html>