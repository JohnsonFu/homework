<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="GB2312">
    <title>举报用户</title>
</head>
<?PHP
$time =time()+8*60*60;
$date='20'.date("y-m-d H:i",$time);
session_start();

?>
<?PHP session_write_close(); ?>

<body>
<div id="main">
<header style="text-align:center">处理举报</header>
    <table style="margin-bottom:15px;width:100%;height:100%;word-break:break-all;"cellspacing="0" cellpadding="0"border="1">
        <tr>
            <td width="30%">举报者</td>
            <td><label style="width:40%"  name="fromname" id="fromname"></label>
                <input type="text" style="display:none" id="toid" name="toid">
            </td>
        </tr>
        <tr>
            <td width="30%">被举报者</td>
            <td><label style="width:40%" placeholder="邮件标题" name="toname" id="toname"></label><input type="text" style="display:none" id="reportid" name="reportid"></td>
        </tr>
        <tr>
            <td width="30%">举报内容</td>
            <td><label id="content" name="content" type="text" style="width:80%" ></td>
        </tr>
        <tr>
            <td width="30%">处罚金币值</td>
            <td>
                <select  size="1" id="money" name="money"><?PHP for($s=1;$s<7;$s++){
                        ?>
                        <option value =<?PHP echo($s*0.1) ?>><?PHP echo($s.'0%') ?></option>
                    <?PHP } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td width="30%">处罚经验值</td>
            <td>
                <select  size="1" id="exp" name="exp"><?PHP for($s=1;$s<7;$s++){
                        ?>
                        <option value =<?PHP echo($s*0.1) ?>><?PHP echo($s.'0%') ?></option>
                    <?PHP } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td width="30%">时间</td>
            <td ><?PHP echo $date ?><input type="text" style="display:none" name="time" value=<?PHP echo $date ?>></td>
        </tr>
    </table>
    <input  type="button" value="处理" style="float:right" onclick="process()" >
    </div>
</body>
<script type="text/javascript">
    urlinfo=decodeURI(window.location.href);  //获取当前页面的url
    len=urlinfo.length;//获取url的长度
    offset=urlinfo.indexOf("?");//设置参数字符串开始的位置
    newsidinfo=urlinfo.substr(offset,len)//取出参数字符串 这里会获得类似“id=1”这样的字符串
    newsids=newsidinfo.split("=");//对获得的参数字符串按照“=”进行分割
    info=newsids[1].split("_");
    document.getElementById('fromname').innerHTML=info[0];
    document.getElementById('toname').innerHTML=info[1];
    document.getElementById('content').innerHTML=info[2];
    document.getElementById('reportid').value=info[0]+info[1];

    function process()
    {
        fromid=document.getElementById('reportid').value;
        toid=document.getElementById('toid').value;
        exp=document.getElementById('exp').value;
        money=document.getElementById('money').value;
        str=fromid+"-"+toid+"-"+exp+"-"+money;
        xmlHttp=GetXmlHttpObject()
        if (xmlHttp==null)
        {
            alert ("Browser does not support HTTP Request")
            return
        }
        var url="DataProcess/MailInfo/sendReport.php"
        url=url+"?q="+str
        url=url+"&sid="+Math.random()
        xmlHttp.onreadystatechange=function(){
            if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
            {
              //  alert(xmlHttp.responseText);
                document.getElementById('main').innerHTML=xmlHttp.responseText;
                refresh();
            }
        }
        xmlHttp.open("GET",url,true)
        xmlHttp.send(null)
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

    function refresh(){
        window.opener.location.reload();
    }
</script>
</html>