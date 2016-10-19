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
          height:75px;
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
if(!isset($_SESSION['userid'])){
    echo "<script>alert('未登录!将返回登录界面....');</script>";
    echo "<meta http-equiv='Refresh' content='0;URL=../login.html'>";
}else{
$id=$_SESSION['userid'];
include('../DataProcess/AccountInfo/Account.php');
    $account=new Account($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
$list=$account->getAllUsers();
}


?>
<body>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul >
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="../SportPage/sport.html" >运动</a></li>
            <li><a href="#">竞赛</a></li>
            <li><a href="#">俱乐部</a></li>
            <li><a href="#">朋友圈</a></li>
            <li><a href="#" >个人账户</a></li>
            <li><a href="#">退出登录</a></li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div id="header">好友关系</div>
    <div id="vertmenu">
        <ul>
            <li><a href="friend.php" >我的好友</a></li>
            <li><a href="people.php" style=" color: #daddf0; background-color: #80c3f7;">用户搜索</a></li>
        </ul>
    </div>
</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">用户搜索</div><hr style="margin-right: 50px;">
        <div style="margin-left:53%;"><input type="text" class="textview" name="friendname" placeholder="请输入昵称"><input type="button" class="mybutton" value="搜索">
  </div>
<?PHP for($i=0;$i<count($list);$i++){?>
        <div class="peopleitem">
            <table  style="width:100%;height:100%;word-break:break-all;"cellspacing="0" cellpadding="0">
                <tr style="text-align: center;font-size:15px;" >
                    <td style="background-color: #61c5f0;width:20%;"><label class="ilabel" style="font-size:16px;">用户名</label><br><label class="ilabel2" style="font-size:15px;"><?PHP echo ($list[$i]['nickname'])?></label></td>
                    <td style="background-color: #67d0fd;width:15%"><label class="ilabel">等级</label><br><label class="ilabel2">LEVEL&nbsp;<?PHP echo ($list[$i]['level'])?></label></td>
                    <td style="background-color: #8de0ff;width:30%"><label class="ilabel">个性签名</label><br><label class="ilabel2" style="font-size:15px;"><?PHP echo ($list[$i]['signature'])?></label></td>
                    <td style="background-color: #8dd0ff;width:20%"><label class="ilabel">加为好友</label></td>
                    <td style="background-color: #80c4ff;width:15%"><label class="ilabel">发私信</label></td>
                </tr>
            </table>
        </div>
       <?PHP } ?>
</div>
</body>


</body>
</html>