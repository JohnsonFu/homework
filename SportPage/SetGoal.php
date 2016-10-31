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
    include('../DataProcess/AccountInfo/Account.php');
    $level=$_SESSION['level'];
    $account=new Account($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
    $SetGoal=$account->hasSetGoal();
    $goal=$account->getGoal();
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
                <li><a href="#" style="color:#daddf0; background-color: #80c3f7;">
                设定目标</a></li>
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
                    </select>
                     <label style="margin-left:52px;">已设周期:&nbsp;&nbsp;<?PHP if($SetGoal==true){echo $goal[0]['cycle'].'天';}else{echo '无';} ?></label>

                    </div>
                    <div style="margin-bottom:20px;"><label style="margin-left:-10px;margin-right:30px">起始时间</label><?PHP echo $date ?> <label style="margin-left:30px;margin-right:20px;">已设时间:</label><?PHP if($SetGoal==true){echo $goal[0]['time'];}else{echo '无';} ?></div>
                 <div style="margin-bottom:20px"> <label style="margin-left:-10px;">每日距离<input id="dist" name="type1" value="distance" type="radio" checked ></label>
                    <select style="margin-left:30px;width:100px;height:30px;"  name="type2"><?PHP
                        for($j=10;$j<=200;$j++){ ?>
                            <option value="<?PHP echo $j/10 ?>"><?PHP echo $j/10 ?>KM</option>
                        <?PHP } ?>
                    </select> <label style="margin-left:35px;margin-right:20px;">已设运动量:&nbsp;&nbsp;<?PHP if($SetGoal==true){if($goal[0]['type']=='distance'){echo $goal[0]['nums'].'KM/天';}else{echo $goal[0]['nums'].'步/天';}}else{echo '无';} ?></label>
                   </div>
                    <div style="margin-bottom:20px">  <label style="margin-left:-10px;">每日步数<input name="type1" id="step" value="walk" type="radio" "  ></label>
                    <select style="margin-left:30px;width:100px;height:30px;"  name="type3"><?PHP
                        for($j=500;$j<=5000;$j=$j+100){ ?>
                            <option value="<?PHP echo $j*10 ?>"><?PHP echo $j*10 ?>步</option>
                        <?PHP } ?>
                    </select> <input style="margin-left:60px"  type="submit" value="提交"> <?PHP if($SetGoal==true){ ?> <input type="button" name='<?PHP echo $id;?>' onclick="deletegoal(this.name)" value="删除目标"><?PHP } ?></div>
                  <div >

                    </div>
                    </form>
                    <hr style="margin-right: 80px;">
                    </div>
        </div>

    </div>


<?PHP } ?>
<script type="text/javascript" >
function deletegoal(str){
    if (str.length==0)
    {

        return
    }
   xmlHttp=GetXmlHttpObject()
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request")
        return
    }
    var url="../DataProcess/GameInfo/DeleteGoal.php"
    url=url+"?q="+str
    url=url+"&sid="+Math.random()
    xmlHttp.onreadystatechange=stateChanged1
    xmlHttp.open("GET",url,true)
    xmlHttp.send(null)
}

function stateChanged1()
{
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    {
        alert(xmlHttp.responseText);
        if(xmlHttp.responseText=='删除成功')
            window.location.reload();
    }
}


function GetXmlHttpObject()
{
    var xmlHttp=null;
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
        // Internet Explorer
        try
        {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}
</script>
</body>
</html>