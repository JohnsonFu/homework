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
include('../DataProcess/GameInfo/mygame.php');
include('../DataProcess/AccountInfo/Account.php');
$account=new Account($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
$list=getGameList('sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
$mygame=new mygame('sqlite:../DataProcess/AccountInfo/mydatabase.sqlite',$id);
function getNick($id){
    $db=new PDO('sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
    $res=$db->query("select nickname from users where id='$id'")->fetchAll()[0][0];
    return $res;
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
        <label style="margin-left:-40px;">胜率:</label><hr>
        <button type="button"  class="login-btn register-btn" id="button" onclick="jump()" style="margin-top:12px;margin-left:0%;width:110px;font-size:20px;">发起竞赛</button>
        <a href="#" style="font-size:18px;">规则介绍</a>
    </div>
    <div id="vertmenu" >
        <ul>
            <li style="margin-top:10px; "><a href="gameboard.php" >竞赛场</a></li>
            <li style="margin-top:10px;"><a href="#">我的战绩</a></li>
            <li style="margin-left:-5px;margin-top:10px;font-size:20px;"><a href="owngame.php">发起的竞赛</a></li>
            <li style="margin-left:-5px;margin-top:10px;font-size:20px;"><a href="myjoingame.php" style="color:#daddf0; background-color: #80c3f7;">参加的竞赛</a></li>
        </ul>
    </div>

</div>
<div id="content" style="height:auto">
    <div class="insidecontent" style="height:auto">

        <div class="mylabel">参加的竞赛</div><hr style="margin-right: 50px;">
        <?PHP for($i=0;$i<count($list);$i++) {
            $a=new Account($list[$i]['masterid'],'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
            $picid=$a->getPicId();
            ?>
            <?PHP if($id!=$a->id){ ?>
                <?PHP if($account->isJoinGame($list[$i]['id'])){ ?>
            <div class="gameinfo" style="border-style:solid; border-width:1px; border-color:#000">
                <div class="gameheader" style="padding-bottom:3px; border-bottom-style:solid;font-size:18px; border-width:1px; border-color:#000"><?PHP echo($list[$i]['id']) ?>&nbsp;&nbsp;&nbsp;<?PHP echo($list[$i]['gamename'])?>
                    <input type="button" value="退出" name=<?PHP echo $id.'-' ?><?PHP echo $list[$i]['id']?> onclick="quitgame(this.name)" class="tablebutton" style=";font-size:20px;width:70px;float:right;height:25px;">

                </div>
                <table  style="font-size:10px;width:100%;text-align:center"  cellspacing="0" >
                    <tr style="font-size:13px;">
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">发起者</td>
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">名称</td>
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;">类型</td>
                    </tr>
                    <tr style="font-size:13px;background-color:#ececec;">
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;"> <img src="../headpics/<?PHP echo($picid)?>.gif" style="margin-top:4px;" width="20px;" height="20px'"><?PHP echo(getNick($list[$i]['masterid']))?></td>
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;"><?PHP echo($list[$i]['gamename'])?></td>
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;"><?PHP echo($list[$i]['gametype'])?></td>
                    </tr>
                    <tr style="font-size:13px;">
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">人数</td>
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;border-right-style:solid;">离竞赛开始还有</td>
                        <td style="border-bottom-style:solid; border-width:1px;border-color:#000;">奖金</td>
                    </tr>
                    <tr style="font-size:13px;background-color:#ececec;">
                        <td style=" border-width:1px;border-color:#000;border-right-style:solid;"><?PHP echo count($mygame->getgamejoiner($list[$i]['id']))?></td>
                        <td style="border-width:1px;border-color:#000;border-right-style:solid;">1天2小时3分</td>
                        <td style=" border-width:1px;border-color:#000;">1000</td>
                    </tr>
                </table>
            </div>
                <?PHP } ?>
            <?PHP } ?>
        <?PHP } ?>

    </div>


</div>
<?PHP } ?>

<script language="javascript">
    function jump(){
        window.location.href="SetGame.php";
    }



    function quitgame(str){

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
        var url="../DataProcess/GameInfo/QuitGame.php"
        url=url+"?q="+str
        url=url+"&sid="+Math.random()
        xmlHttp.onreadystatechange=stateChanged
        xmlHttp.open("GET",url,true)
        xmlHttp.send(null)
    }

    function stateChanged()
    {
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
        {
            alert(xmlHttp.responseText);
            if(xmlHttp.responseText=='退出成功')
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