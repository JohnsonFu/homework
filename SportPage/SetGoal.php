<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body{
            color:#55555c;font-family: 微软雅黑;
        }


    </style>

    <link rel="stylesheet" type="text/css" href="SportCss.css">
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


    ?>
    <div id="top_bg">
        <div class="logo_l"></div>
        <div id="menu">
            <ul >
                <li><a href="../homepage.php">首页</a></li>
                <li><a href="../SportPage/MySport.php" style="color:#9eff9d;">运动</a></li>
                <li><a href="../GamePage/gameboard.php">竞赛</a></li>
                <li><a href="../AccountPage/friend.php">社交</a></li>
                <li><a href="../CirclePage/mycircle.php">朋友圈</a></li>
                <li><a href="../AccountPage/personinfo.php">个人账户</a></li>
                <li><a href="../DataProcess/AccountInfo/Logout.php">退出登录</a></li>
            </ul>
        </div>
    </div>
    <div id="leftbar">
        <div id="header">健康管理</div>
        <div id="vertmenu">
            <ul>
                <li><a href="MySport.php" >我的运动</a></li>
                <li><a href="#" style="color:#daddf0; background-color: #80c3f7;">设定目标</a></li>
                <li><a href="exercise.php">健身追踪</a></li>
                <li><a href="#">睡眠分析</a></li>
            </ul>
        </div>
    </div>
    <div id="content">
        <div class="insidecontent">
            <div class="mylabel">设定目标</div><hr style="margin-right: 50px;">
            <form method="post" action="../DataProcess/GameInfo/ChangeGoal.php" >
                <div style="margin-left:20px;">
                    <div style="margin-bottom:20px;">
                    <label style="margin-left:-10px;">目标周期</label>
                    <select style="margin-left:30px;width:100px;height:30px;"  name="cycle"><?PHP
                        $time =time()+32*60*60;
                        $date='20'.date("y-m-d",$time);
                        for($k=5;$k<=30;$k++){ ?>
                        <option value="<?PHP echo $k ?>"><?PHP echo $k ?>天</option>
                     <?PHP } ?>
                    </select></div>
                    <div style="margin-bottom:20px;"><label style="margin-left:-10px;margin-right:30px">起始时间</label><?PHP echo $date ?></div>
                 <div style="margin-bottom:20px"> <label style="margin-left:-10px;">每日距离<input id="dist" name="type1" value="distance" type="radio" checked ></label>
                    <select style="margin-left:30px;width:100px;height:30px;"  name="type2"><?PHP
                        for($j=10;$j<=200;$j++){ ?>
                            <option value="<?PHP echo $j/10 ?>"><?PHP echo $j/10 ?>KM</option>
                        <?PHP } ?>
                    </select>
                   </div>
                    <div style="margin-bottom:20px">  <label style="margin-left:-10px;">每日步数<input name="type1" id="step" value="walk" type="radio" "  ></label>
                    <select style="margin-left:30px;width:100px;height:30px;"  name="type3"><?PHP
                        for($j=500;$j<=5000;$j=$j+100){ ?>
                            <option value="<?PHP echo $j*10 ?>"><?PHP echo $j*10 ?>步</option>
                        <?PHP } ?>
                    </select> <input  type="submit" value="设定目标"></div>
                  <div >

                    </div>
                    </form>
                    <hr style="margin-right: 80px;">
                    </div>
        </div>

    </div>


<?PHP } ?>
<script type="text/javascript" src="../jquery-1.8.3/jquery.js">

</script>
</body>
</html>