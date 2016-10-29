<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
    <link rel="stylesheet" type="text/css" href="AccountCss.css">
    <style type="text/css">
        .peopleitem{
            width:91%;
            height:100px;
            margin-bottom:20px;
        }
        .ilabel{
            font-family:"Yuanti SC";
            color:whitesmoke;
            font-size:15px;
        }
        .ilabel2{
            font-family:"Yuanti SC";
            color:whitesmoke;
            font-size:18px;
        }
    </style>
</head>
<?PHP
session_start();
function afterread($mid){
    $db=new PDO('sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
    $db->query("update mail set hasread='1' where mid='$mid'");
}
if(!isset($_SESSION['userid'])){
    echo "<script>alert('未登录!将返回登录界面....');</script>";
echo "<meta http-equiv='Refresh' content='0;URL=../login.html'>";
}else{
    $id=$_SESSION['userid'];
    include('../DataProcess/AccountInfo/Account.php');
    $account=new Account($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
    $mails=$account->getMail();

}
?>
<body>
<div id="top_bg">
        <div class="logo_l"></div>
        <div id="menu">
        <ul >
        <li><a href="../homepage.php">首页</a></li>
        <li><a href="../SportPage/MySport.php" >运动</a></li>
        <li><a href="../GamePage/gameboard.php">竞赛</a></li>
        <li><a href="friend.php">社交</a></li>
        <li><a href="../CirclePage/mycircle.php">朋友圈</a></li>
        <li><a href="personinfo.php" >个人账户</a></li>
        <li><a href="../DataProcess/AccountInfo/Logout.php">退出登录</a></li>
        </ul>
        </div>
        </div>
        <div id="leftbar">
        <div id="header">好友关系</div>
        <div id="vertmenu">
        <ul>
        <li><a href="#" style=" color: #daddf0; background-color: #80c3f7;">我的邮箱</a></li>
        <li><a href="friend.php" >我的好友</a></li>
        <li><a href="myfollow.php">我的关注</a></li>
        <li><a href="followme.php">我的粉丝</a></li>
        <li><a href="people.php">用户搜索</a></li>
        </ul>
        </div>
        </div>
        <div id="content">
        <div class="insidecontent">
        <div class="mylabel">邮箱</div><hr style="margin-right: 50px;">
        <div style="margin-left:53%;"><input type="text" class="textview" name="friendname" placeholder="请输入昵称"><input type="button" class="mybutton" value="搜索">
</div>
<div>
    <?PHP
    for($k=0;$k<count($mails);$k++){
             $fid=$mails[$k]['fid'];
        $mid=$mails[$k]['mid'];
    $content=$mails[$k]['contents'];
        $time=$mails[$k]['time'];
    $tittle=$mails[$k]['tittle'];
        $faccount=new Account($fid,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
        $fnick=$faccount->getNick();
        $fpicid=$faccount->getPicId();
        $hasread=$mails[$k]['hasread'];

        $rfid=$mails[$k]['tid'];
        $rfaccount=new Account($rfid,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
        $rfnick=$rfaccount->getNick();
        $rfpicid=$rfaccount->getPicId();
    ?>
    <table style="margin-bottom:15px;width:80%;height:100%;word-break:break-all;"cellspacing="0" cellpadding="0"border="1">
        <tr>
            <td style="font-size:15px"><?PHP if($fid!=$id&&$hasread==0){echo '(未读)';afterread($mid);} ?>发信人:<?PHP echo $fnick ?><img src="../headpics/<?PHP echo($fpicid) ?>.gif"width="15px"height="15px"> <label>&nbsp;&nbsp;&nbsp;标题:<?PHP echo $tittle ?></label> <label style="float:right"><?PHP echo $time ?></label><br>
           <?PHP echo $content ?>
            </td>
        </tr>
        <?PHP $replymail=$account->getReplyMail($mid);
        for($j=0;$j<count($replymail);$j++){

        ?>
        <tr>
           <?PHP  if($replymail[$j]['fid']!=$id){
                $mfid=$replymail[$j]['fid'];
                $mfaccount=new Account($mfid,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
                $mfnick=$mfaccount->getNick();
                $mfpicid=$mfaccount->getPicId();
                ?>
                <td style="font-size:15px"><?PHP echo $mfnick ?><img src="../headpics/<?PHP echo($mfpicid) ?>.gif"width="15px"height="15px"> 回复:我 <label style="float:right"> 昨天16:45</label><br>
                    <?PHP echo $replymail[$j]['contents'] ?>
                </td>
            <?PHP }else{
               $tfid=$replymail[$j]['tid'];
               $tfaccount=new Account($tfid,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
               $tfnick=$tfaccount->getNick();
               $tfpicid=$tfaccount->getPicId();

                ?>
                <td style="font-size:15px">我 回复:<?PHP echo $tfnick ?>  <img src="../headpics/<?PHP echo($tfpicid) ?>.gif"width="15px"height="15px"><label style="float:right">昨天16:45</label><br>
                    <?PHP echo $replymail[$j]['contents'] ?>
                </td>
            <?PHP } ?>
        </tr>
        <?PHP } ?>
        <?PHP if($fid==$id){
        ?>
        <tr>
            <td style="font-size:15px">回复:<?PHP echo $rfnick ?>  <img src="../headpics/<?PHP echo($rfpicid) ?>.gif"width="15px"height="15px"><input type="text" id="replycontent<?PHP echo $mid?>" style="width:50%;margin-left:60px;" placeholder="回复<?PHP echo $rfnick ?>" >
                <input type="button" name=<?PHP echo $mid.'-'.$id.'-'.$rfid ?>  value="回复" onclick="reply(this.name)" >
            </td>
        </tr>
        <?PHP }else{?>
            <tr>
                <td style="font-size:15px">回复:<?PHP echo $fnick ?>  <img src="../headpics/<?PHP echo($fpicid) ?>.gif"width="15px"height="15px"><input type="text" id="replycontent<?PHP echo $mid?>" style="width:50%;margin-left:60px;" placeholder="回复<?PHP echo $fnick ?>" >
                    <input type="button" name=<?PHP echo $mid.'-'.$id.'-'.$fid ?>  value="回复" onclick="reply(this.name)" >
                </td>
            </tr>

    </table>
    <?PHP }} ?>


</div>
</div>
</body>
<script type="text/javascript" >

var xmlHttp



function reply(str)
{
    var k=str.split('-');
    var addr=k[0]
    var content=document.getElementById('replycontent'+addr).value;
  if(content==''){
      alert('回复不得为空');
      return
  }
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
    var url="../DataProcess/MailInfo/ReplyMail.php"
    url=url+"?q="+str+'-'+content;
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