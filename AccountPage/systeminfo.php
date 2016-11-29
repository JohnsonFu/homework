<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>系统邮件</title>
    <link rel="stylesheet" type="text/css"
          href="../logregis.css"/>
    <link rel="stylesheet" type="text/css" href="AccountCss.css">
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
    $nickname=$account->getNick();
    $password=$account->getPassword();
    $sig=$account->getSig();
    $level=$account->getLevel();
    $money=$account->getMoney();
    $myreport=$account->getMyreport();
    $reporttome=$account->getReportTome();
    ?>


    <div id="top_bg">
        <div class="logo_l"></div>
        <div id="menu">
            <ul >
                <li><a href="../homepage.php">首页</a></li>
                <li><a href="../SportPage/MySport.php" >运动</a></li>
                <li><a href="../GamePage/gameboard.php">竞赛</a></li>
                <li><a href="friend.php">社交</a></li>
                <li><a href="../CirclePage/mycircle.php">朋友圈</a></li>
                <li><a href="personinfo.php" style="color:#9eff9d;" >个人账户</a></li>
                <li><a href="../DataProcess/AccountInfo/Logout.php">退出登录</a></li>

            </ul>
        </div>
    </div>
    <div id="leftbar">
        <div id="header">个人账户</div>
        <div id="vertmenu">
            <ul>
                <li><a href="personinfo.php">基本信息</a></li>
                <li><a href="#" style=" color: #daddf0; background-color: #80c3f7;">系统邮件</a></li>
            </ul>
        </div>
    </div>
    <div id="content">
        <form method="POST" action="../DataProcess/AccountInfo/Modify.php" onsubmit="return check()">
            <div class="insidecontent">
                <div class="mylabel">系统邮件</div>
                <hr style="margin-right: 50px;">
                <?PHP foreach($myreport as $item){
                ?>
                <div style="font-size:15px;width:90%;"><?PHP echo $item; ?></div>
                <?PHP } ?>
                <?PHP foreach($reporttome as $item2){
                    ?>
                    <div style="font-size:15px;width:90%;"><?PHP echo $item2; ?></div>
                <?PHP } ?>
                <br>
                </div>
        </form>
        <?PHP session_write_close(); ?>
    </div>
    <div class="footer">
        <p>爱运动 - isport</p>
        <p>Designed By FuLinhua 2016</p>
    </div>
<?PHP } ?>
<script language="JavaScript">

</script>

</body>
</html>