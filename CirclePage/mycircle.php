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
        <li><a href="#" style="font-size:19px; color: #daddf0; background-color: #80c3f7;">关注者动态</a></li>
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
 <table>
                <tr>
                    <th style="background-color: #eaf2f2;font-size:12px;" rowspan="2"><img src="../headpics/<?PHP echo($fpicid);?>.gif" style="margin:5px 5px 5px 5px"><br><?PHP echo($fnickname); ?></th>
                    <th style="font-size:12px;text-align: left;">标题:<?PHP echo($list[$i]['tittle']); ?>&nbsp;&nbsp;&nbsp;&nbsp;时间:<?PHP echo($list[$i]['time']); ?><input type="button" value="点赞<?PHP echo($list[$i]['thumbs']); ?>" style="float:right;"><br>
                        运动距离:5KM&nbsp;&nbsp;&nbsp;朋友圈排名:2<input type="button" value="评论" style="float: right"></th>

                </tr>
                <tr>

                    <td style="width:80%;font-size:16px;"><?PHP echo($list[$i]['content']); ?>.</td>
                </tr>
<tr style="font-size:16px;"><td style="text-align:center">评论者</td><td style="text-align:center">评论内容</td></tr>
            </table>
    <?PHP } ?>


</div>
            <script language="javascript">
                function jump(){
                    window.location.href="SetCircle.php";
                }

            </script>


</body>
</html>