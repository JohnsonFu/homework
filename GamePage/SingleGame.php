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
$name= $_SESSION['gamename'];
$gameid=$_SESSION['gameid'];
$joinlist=$mygame->getJoinerRankInfo($gameid);
$game=$mygame->getGame($gameid);
include('../DataProcess/GameInfo/TimeProcess.php');
session_write_close();
function cuttime($time){
    $arr=explode("-",$time);
    return $arr[1].'-'.$arr[2];

}
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
        <a href="#" style="font-size:18px;">规则介绍</a>
    </div>
    <div id="vertmenu" >
        <ul>
            <li style="margin-top:10px; "><a href="gameboard.php" style="color:#daddf0; background-color: #80c3f7;">竞赛场</a></li>
            <li style="margin-top:10px;"><a href="myGameResult.php">我的战绩</a></li>
            <li style="margin-left:-5px;margin-top:10px;font-size:20px;"><a href="owngame.php">发起的竞赛</a></li>
            <li style="margin-left:-5px;margin-top:10px;font-size:20px;"><a href="myjoingame.php">参加的竞赛</a></li>
        </ul>
    </div>

</div>
<div id="content" style="height:auto">
    <div class="insidecontent" style="height:auto">

        <div class="mylabel"><?PHP echo $name?></div><hr style="margin-right: 50px;">
       <header><img style="padding-top:10px;" src="../headpics/yundong.png" width="25px" height="25px">&nbsp;&nbsp;多人竞赛</header>
<div style="width:80%;border-radius:5px;height:100px;background-color: #dddddd">

<label style="font-size:18px;margin-left:20px"><?PHP echo getTimeMinus($game['starttime'],$game['endtime'])?></label>
<label style="font-size:18px;float:right;margin-right:50px">总金额&nbsp;&nbsp;<label style="font-size:21px"><?PHP echo $game['allmoney'] ?></label>金</label><br>
    <label style="font-size:18px;margin-left:20px"><?PHP echo cuttime($game['starttime']) ?> 至 <?PHP echo cuttime($game['endtime'])?></label>
    <label style="font-size:18px;float:right;margin-right:50px;">保证金&nbsp;&nbsp;<label style="font-size:21px"><?PHP echo $game['joinmoney']?></label>金

</label>
</div>
        <header style="margin-left:40px;"></header>

        <?PHP
        $count=0;
        foreach($joinlist as $item){
            $count++;
            ?>
       <?PHP echo $count.' ';?><img src="../headpics/<?PHP echo $item['picid']?>.gif" width="30px" height="30px">
        <?PHP echo $item['nickname']."----".$item['totalkm'].'KM';?>
        <br>

<?PHP } ?>
</div>
<?PHP }unset($list); ?>

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