<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员</title>
    <link rel="stylesheet" type="text/css"
          href="logregis.css"/>
    <link rel="stylesheet" type="text/css" href="AccountPage/AccountCss.css">
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
<body>
<?PHP
session_start();
if(!isset($_SESSION['managerid'])){
    echo "<script>alert('未登录!将返回登录界面....');</script>";
    echo "<meta http-equiv='Refresh' content='0;URL=manlogin.html'>";
}else{
    include('DataProcess/AccountInfo/Manager.php');
    include('DataProcess/AccountInfo/Account.php');
    $id=$_SESSION['managerid'];
    $dbaddr='sqlite:DataProcess/AccountInfo/mydatabase.sqlite';
    $manager=new Manager($id,$dbaddr);
    $checklist=$manager->getCheckReport();
    function getPic($i){
        if($i==0){
            return 'disagree';
        }if($i==1){
            return 'agree';
        }
    }
    function getDes($i){
        if($i==0){
            return '驳回';
        }if($i==1){
            return '同意';
        }
    }
}
?>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul style="float:right">
            <li><a href="DataProcess/AccountInfo/Logout2.php">退出登录</a></li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div id="header">用户管理</div>
    <div id="vertmenu">
        <ul>
            <li><a href="manager.php" >举报处理</a></li>
            <li><a href="#" style=" color: #daddf0; background-color: #80c3f7;" >处理历史</a></li>
        </ul>
    </div>
</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">举报处理</div><hr style="margin-right: 50px;">
        <div style="margin-left:53%;height:50px;"></div>
        <?PHP
        foreach($checklist as $item){

            ?>
            <div class="peopleitem">
                <table  style="width:100%;height:100%;word-break:break-all;"cellspacing="0" cellpadding="0">
                    <tr style="text-align: center;font-size:15px;" >
                        <td style="background-color: #67d0fd;width:10%"><label class="ilabel">举报者ID</label><br><label class="ilabel2"><?PHP echo ($item['fromid'])?></label></td>
                        <td style="background-color: #8de0ff;width:20%"><label class="ilabel">被举报者ID</label><br><label class="ilabel2" style="font-size:15px;"><?PHP echo ($item['toid'])?></label></td>
                        <td style="background-color: #8dd0ff;width:20%"  ><label class="ilabel">举报理由</label><br><label class="ilabel2" style="font-size:15px;"><?PHP echo ($item['reason'])?></label></td>
                        <td style="background-color: #80c4ff;width:15%"><label class="ilabel">处理结果<br><img src="img/<?PHP echo getPic($item['approve']); ?>.png" width="40px" height="40px"><br><?PHP echo getDes($item['approve']) ?></label></td>
                       <?PHP if($item['approve']==1){ ?>
                        <td style="background-color: #8de0ff;width:15%"><label class="ilabel">惩罚结果<br><?PHP echo '金币'.($item['minusmoney']*100).'%' ?><br>
                                <?PHP echo '经验值'.($item['minusexp']*100).'%' ?>  </label></td>
                   <?PHP }else{?>
                <td style="background-color: #8de0ff;width:15%"><label class="ilabel">惩罚措施<br>无</label></td>
                        <?PHP } ?>
                    </tr>
                </table>

            </div>
        <?PHP }?>

    </div>
    <?PHP session_write_close(); ?>
</body>
<script type="text/javascript">
</script>
</html>