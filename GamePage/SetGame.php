<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发起竞赛</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
   <link rel="stylesheet" type="text/css" href="gamecss.css">
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
    $nickname=$_SESSION['nickname'];
    $level=$_SESSION['level'];
    $picid=$_SESSION['picid'];
    session_write_close();

?>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul>
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="../SportPage/MySport.php">运动</a></li>
            <li><a href="gameboard.php"  style="color:#c3ffa2;">竞赛</a></li>
            <li><a href="../AccountPage/friend.php">社交</a></li>
            <li><a href="../CirclePage/mycircle.php">朋友圈</a></li>
            <li><a href="../AccountPage/personinfo.php">个人账户</a></li>
            <li><a href="../DataProcess/AccountInfo/Logout.php">退出登录</a></li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div align="center" class="infobar">
        <img src="../headpics/<?PHP echo($picid)?>.gif"><br>
        <label><?PHP echo $nickname ?></label><br>
        <label>等级:Level<?PHP echo $level ?></label><br>
    <hr>
        <button type="button"  class="login-btn register-btn" id="button" onclick="jump()" style="margin-top:12px;margin-left:0%;width:110px;font-size:20px;">发起竞赛</button>
    </div>
    <div id="vertmenu">
        <ul>
            <li style="margin-top:10px; "><a href="gameboard.php" >竞赛场</a></li>
            <li style="margin-top:10px;"><a href="myGameResult.php">我的战绩</a></li>
            <li style="margin-left:-5px;margin-top:10px;font-size:20px;"><a href="owngame.php">发起的竞赛</a></li>
            <li style="margin-left:-5px;margin-top:10px;font-size:20px;"><a href="myjoingame.php">参加的竞赛</a></li>
        </ul>
    </div>

</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">发起竞赛</div><hr style="margin-right: 50px;">
<form method="post" action="../DataProcess/GameInfo/AddGame.php" onsubmit="return checktime()">
        <div style="margin-left:20px;">
        <label style="margin-left:-10px;">竞赛名称</label><input name="gamename" id="gamename" type="text" style="margin-left:30px;height:20px;font-family:Helvetica;font-size:15px;"><br>
        <label style="margin-left:-10px;">运动类型</label>
        <select style="margin-left:30px;width:100px;height:30px;"  name="type">
            <option value="单人PK">单人PK</option>
            <option value="群体PK">群体PK</option>
        </select><br>
        <label style="margin-left:-10px;">开始时间</label><input style="margin-left:30px;" id="datetimepicker2" type="text" name="starttime"><br>
        <label style="margin-left:-10px;">结束时间</label><input style="margin-left:30px;" id="datetimepicker7" type="text" name="endtime"><br>
        <label style="margin-left:-10px;">保&nbsp;证&nbsp;金&nbsp;&nbsp;&nbsp;</label><input type="text" class="textview" id="money"  name="money" style="width:60px; margin-left:25px;height:20px;margin-right:20px;"><label style="font-size:15px;">金币</label>
<br>
            <label style="vertical-align: top;margin-left:-10px;">竞赛介绍</label><textarea name="description" style="margin-top:5px;margin-left:30px;width:400px;height:50px;padding:5px 5px 5px 5px;  border-radius: 2px 2px 2px 2px;
            font-size:18px;background-color: #f7f7f7;"></textarea>
            <button type="submit"  class="login-btn register-btn" id="button" style="margin-left:69%;width:70px;">建立竞赛</button>
</div>
    </form>
        </div>

</div>


<?PHP } ?>
<script type="text/javascript">
    $('#datetimepicker2').datetimepicker({
        lang:'en',
        timepicker:false,
        format:'Y-m-d',
        formatDate:'Y/m/d',
    });
    $('#datetimepicker7').datetimepicker({
        lang:'en',
        timepicker:false,
        format:'Y-m-d',
        formatDate:'Y-m-d',
    });
    $('#datetimepicker2').datetimepicker();
    $('#datetimepicker7').datetimepicker();
    function checktime() {
        var time1=document.getElementById('datetimepicker2').value;
        var time2=document.getElementById('datetimepicker7').value;
        var money=document.getElementById('money').value;
        var name=document.getElementById('gamename').value;
        if(name==''){
            alert('名称不得为空');
            return false;
        }else {
            if (isNaN(money)) {
                alert('保证金必须为数字.')
                return false;
            } else {
                if (Date.parse(time1) < Date.parse(time2)) {
                    return true;
                }
                else {
                    alert('结束时间必须大于开始时间');
                    return false;
                }
            }
        }


    }
</script>
</body>
</html>