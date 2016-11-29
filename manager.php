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
    echo "<meta http-equiv='Refresh' content='0;URL=managerlogin.html'>";
}else{
    include('DataProcess/AccountInfo/Manager.php');
    include('DataProcess/AccountInfo/Account.php');
    $id=$_SESSION['managerid'];
    $dbaddr='sqlite:DataProcess/AccountInfo/mydatabase.sqlite';
    $manager=new Manager($id,$dbaddr);
    $unchecklist=$manager->getUncheckReport();
}
?>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul >
        </ul>
    </div>
</div>
<div id="leftbar">
    <div id="header">用户管理</div>
    <div id="vertmenu">
        <ul>
            <li><a href="#" style=" color: #daddf0; background-color: #80c3f7;">举报处理</a></li>
            <li><a href="#"  >处理历史</a></li>
        </ul>
    </div>
</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">举报处理</div><hr style="margin-right: 50px;">
        <div style="margin-left:53%;"><input type="text" class="textview" name="friendname" placeholder="请输入昵称"><input type="button" class="mybutton" value="搜索">
        </div>

<?PHP
foreach($unchecklist as $item){

?>
                <div class="peopleitem">
                    <table  style="width:100%;height:100%;word-break:break-all;"cellspacing="0" cellpadding="0">
                        <tr style="text-align: center;font-size:15px;" >
                            <td style="background-color: #67d0fd;width:10%"><label class="ilabel">举报者ID</label><br><label class="ilabel2"><?PHP echo ($item['fromid'])?></label></td>
                            <td style="background-color: #8de0ff;width:20%"><label class="ilabel">被举报者ID</label><br><label class="ilabel2" style="font-size:15px;"><?PHP echo ($item['toid'])?></label></td>
                            <td style="background-color: #8dd0ff;width:20%"  ><label class="ilabel">举报理由</label><br><label class="ilabel2" style="font-size:15px;"><?PHP echo ($item['reason'])?></label></td>
                            <td style="background-color: #80c4ff;width:15%"><label class="ilabel"><img src="../img/call.gif" width="40px" height="40px"  name=<?PHP echo('10'.'_'.'10')?> onclick="sendMsg(this.name)"><br>驳回举报</label></td>
                            <td style="background-color: #8de0ff;width:15%"><label class="ilabel"><img src="../img/jubao.jpg" width="40px" height="40px" name=<?PHP echo('a'.'_'.'a'.'_'.'a')?> onclick="report(this.name)"><br>处理举报</label></td>
                        </tr>
                    </table>

                </div>
<?PHP } ?>

    </div>
    <?PHP session_write_close();unset($list); ?>
</body>
<script type="text/javascript" >

    var xmlHttp

    function sendMsg(str){

        var myWindow=window.open('./sendmsg.php?toname='+str,'','width=400,height=400')
        myWindow.focus();
    }

    function add(str)
    {
        if (str.length==0)
        {
            document.getElementById("txtHint").innerHTML=""
            return
        }
        xmlHttp=GetXmlHttpObject()
        if (xmlHttp==null)
        {
            alert ("Browser does not support HTTP Request")
            return
        }
        var url="../DataProcess/AccountInfo/RemoveFriend.php"
        url=url+"?q="+str
        url=url+"&sid="+Math.random()
        xmlHttp.onreadystatechange=function()
        {
            if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
            {
                window.location.reload();
            }
        }
        xmlHttp.open("GET",url,true)
        xmlHttp.send(null)
    }
    function report(str){
        var myWindow=window.open('./reportmsg.php?toname='+encodeURIComponent(str),'','width=400,height=400')
        myWindow.focus();
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
</html>