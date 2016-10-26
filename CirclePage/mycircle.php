<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
    <link rel="stylesheet" type="text/css" href="../AccountPage/AccountCss.css">
    <style type="text/css">
        .circleitem{
            width:91%;
            height:auto;
            margin-bottom:20px;
            background-color: #aed1f9;
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
        table
        {
            border-collapse:collapse;
            margin-top:15px;
            margin-bottom:15px;
        }

        table, td, th
        {
            border:1px solid black;
        }
    </style>
</head>

<body>
<?PHP
session_start();
if(!isset($_SESSION['userid'])){
    echo "<script>alert('未登录!将返回登录界面....');</script>";
    echo "<meta http-equiv='Refresh' content='0;URL=../login.html'>";
}else{
    $id=$_SESSION['userid'];
    include('../DataProcess/AccountInfo/Account.php');
    include('../DataProcess/CircleInfo/Post.php');
    $account=new Account($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');

    $list=$account->getMyFollowPosts();
}


?>
<div id="top_bg">
        <div class="logo_l"></div>
        <div id="menu">
        <ul >
        <li><a href="../homepage.php">首页</a></li>
        <li><a href="../SportPage/sport.html" >运动</a></li>
        <li><a href="../GamePage/gameboard.php">竞赛</a></li>
        <li><a href="#">俱乐部</a></li>
        <li><a href="#" style="color:#9eff9d;">朋友圈</a></li>
        <li><a href="../AccountPage/personinfo.php" >个人账户</a></li>
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
        <li><a href="#" style="font-size:19px; background-color: #80c3f7;">关注者动态</a></li>
            <li><a href="owncircle.php" style="font-size:20px; ">我的动态</a></li>
        </ul>
        </div>
        </div>
        <div id="content">
        <div class="insidecontent">
        <div class="mylabel">关注者动态</div><hr style="margin-right: 50px;">

<?PHP for($i=0;$i<count($list);$i++){
    $a=new Account($list[$i]['masterid'],'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
    $fpicid=$a->getPicId();
    $fnickname=$a->getNick();

    ?>
 <table width="92%">

                <tr>
                    <th style="background-color: #eaf2f2;font-size:12px;" rowspan="2"><img src="../headpics/<?PHP echo($fpicid);?>.gif" style="margin:5px 5px 5px 5px"><br><?PHP echo($fnickname); ?></th>
                    <th style="font-size:12px;text-align: left;">标题:<?PHP echo($list[$i]['tittle']); ?>&nbsp;&nbsp;&nbsp;&nbsp;时间:<?PHP echo($list[$i]['time']); ?><br>
                        运动距离:5KM&nbsp;&nbsp;&nbsp;postID:<?PHP echo($list[$i]['postid'])?></label><input type="button" id=<?PHP echo($list[$i]['postid'])?> name="<?PHP echo($list[$i]['postid']) ?>" onclick="thumbup(this.name)" value="点赞<?PHP echo($list[$i]['thumbs']); ?>" style="float:right;"></th>

                </tr>
                <tr>
                    <form method="post" action="../DataProcess/CircleInfo/AddComent.php" >
                    <td style="width:80%;font-size:16px;"><?PHP echo($list[$i]['content']); ?>.</td>
                </tr>
     <?PHP if($account->isFriend($list[$i]['masterid'])) {?>
     <tr  id="commentbar" style="font-size:16px;"><td style="text-align:center">我的评论<input type="text" name="postid" style="display: none" value="<?PHP echo($list[$i]['postid']) ?>"><input type="text" name="toid" style="display: none" value="<?PHP echo($list[$i]['masterid']) ?>"></td><td>评论内容<input type="text" name="comment"><input type="submit" value="评论" onclick="submit" style="float:right;"></td></tr>
     <?PHP }?>
     <tr style="font-size:16px;"><td style="text-align:center">评论者</td><td style="text-align:center">评论内容</td></tr>
     </form>
<?PHP
$post=new Post($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
$comments=$post->getComment($list[$i]['postid']);
for($j=0;$j<count($comments);$j++){
    $aa=new Account($comments[$j]['masterid'],'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
   $bb=new Account($comments[$j]['toid'],'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
    $tonick=$bb->getNick();
    $cnick=$aa->getNick();
    $cpicid=$aa->getPicId();
    $topicid=$bb->getPicId();
    $ccontent=$comments[$j]['content'];
    $ctime=$comments[$j]['time'];
    ?>

    <tr style="font-size:16px;"><td style="text-align:center;font-size:12px;"><img src="../headpics/<?PHP echo($cpicid);?>.gif" width="10px;" height="10px" ><?PHP echo($cnick)?>&nbsp;&nbsp;to&nbsp;&nbsp;<img src="../headpics/<?PHP echo($topicid);?>.gif" width="10px;" height="10px" ><?PHP echo($tonick) ?></td><td><?PHP echo($ccontent)?><div style="float:right"><?PHP echo($ctime); ?></div></td></tr>
    <?PHP
}
?>


            </table>
    <?PHP } ?>


</div>
            <script language="javascript">
                function jump(){
                    window.location.href="SetCircle.php";
                }
                function thumbup(str){




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
                    var url="../DataProcess/CircleInfo/thumbup.php"
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
                        var result=xmlHttp.responseText.split('-');

                        var tid=result[2];
                        document.getElementById(tid).value='点赞'+result[1];


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
                function comment(){

                   if( document.getElementById('commentbar').style.visibility=="visible"){
                       document.getElementById('commentbar').style.visibility="hidden"
                   }
                  else  if( document.getElementById('commentbar').style.visibility=="hidden"){
                        document.getElementById('commentbar').style.visibility="visible"
                    }
                }

            </script>


</body>
</html>