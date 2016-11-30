<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的战绩</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
    <link rel="stylesheet" type="text/css" href="gamecss.css">
    <style type="text/css">
        .gameinfo{
            margin-top:10px;
            margin-bottom:10px;
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
</head>
<?PHP
session_start();
if(!isset($_SESSION['userid'])) {
    echo "<script>alert('未登录!将返回登录界面....');</script>";
    echo "<meta http-equiv='Refresh' content='0;URL=../login.html'>";
}else{
$id=$_SESSION['userid'];
$nickname=$_SESSION['nickname'];
$level=$_SESSION['level'];
include('../DataProcess/GameInfo/Game.php');
include('../DataProcess/AccountInfo/Account.php');
include('../DataProcess/GameInfo/mygame.php');
$mygame=new mygame('sqlite:../DataProcess/AccountInfo/mydatabase.sqlite',$id);
$account=new Account($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
$list=$mygame->getGameResult();
session_write_close();
?>
<body>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul>
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="../SportPage/MySport.php">运动</a></li>
            <li><a href="#"  style="color:#c3ffa2;">竞赛</a></li>
            <li><a href="../AccountPage/friend.php">社交</a></li>
            <li><a href="../CirclePage/mycircle.php">朋友圈</a></li>
            <li><a href="../AccountPage/personinfo.php">个人账户</a></li>
            <li><a href="../DataProcess/AccountInfo/Logout.php">退出登录</a></li>


        </ul>
    </div>
</div>
<div id="leftbar">
    <div align="center" class="infobar">
        <img src="../headpics/<?PHP echo($account->getPicId())?>.gif"><br>
        <label><?PHP echo $nickname ?></label><br>
        <label>等级:Level<?PHP echo $level; ?></label><br>
        <hr>
        <button type="button"  class="login-btn register-btn" id="button" onclick="jump()" style="margin-top:12px;margin-left:0%;width:110px;font-size:20px;">发起竞赛</button>
    </div>
    <div id="vertmenu" >
        <ul>
            <li style="margin-top:10px; "><a href="gameboard.php" >竞赛场</a></li>
            <li style="margin-top:10px;"><a href="#" style="color:#daddf0; background-color: #80c3f7;">我的战绩</a></li>
            <li style="margin-left:-5px;margin-top:10px;font-size:20px;"><a href="owngame.php">发起的竞赛</a></li>
            <li style="margin-left:-5px;margin-top:10px;font-size:20px;"><a href="myjoingame.php">参加的竞赛</a></li>
        </ul>
    </div>

</div>
<div id="content" style="height:auto">
    <div class="insidecontent" style="height:auto">
        <div class="mylabel">我的战绩</div><hr style="margin-right: 50px;">
        <?PHP foreach($list as $item){
            $publisher=$item['nick'];
            $count=$item['count'];
            $rank=$item['rank'];
            $money=$item['money'];
            $start=$item['start'];
            $end=$item['end'];
            $exp=$item['exp'];
            ?>
        <div class="peopleitem" >
                <table  style="width:100%;height:50px;;word-break:break-all;"cellspacing="0" cellpadding="0">
                    <tr style="text-align: center;font-size:18px;" >
                        <td style="background-color: #61c5f0;width:16%;">竞赛发布者<br><?PHP echo $publisher; ?></td>
                        <td style="background-color: #67d0fd;width:16%">比赛人数<br><?PHP echo $count;?></td>
                        <td style="background-color: #8de0ff;width:16%">我的排名<br><?PHP echo $rank;?></td>
                        <td style="background-color: #8dd0ff;width:16%">获得金币<br><?PHP echo $money;?></label></td>
                        <td style="background-color: #80c4ff;width:16%">获得经验值<br><?PHP echo $exp;?></label></td>
                        <td style="background-color: #8dd0ff;width:10%">开始<br><?PHP echo $start;?></label></td>
                        <td style="background-color: #80c4ff;width:10%">结束<br><?PHP echo $end;?></label></td>
                    </tr>
                </table>
        </div>
        <?PHP }?>

    <?PHP } ?>

    <script language="javascript">

        function jump(){
            window.location.href="SetGame.php";
        }
        function joingame(str){
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
            var url="../DataProcess/GameInfo/JoinGame.php"
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
                if(xmlHttp.responseText=='参与成功')
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