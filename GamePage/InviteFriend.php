<!DOCTYPE html>
<html lang="en">
<head>
    <title>发送私信</title>
</head>
<?PHP
$time =time()+8*60*60;
$date='20'.date("y-m-d H:i",$time);
session_start();
$nick=$_SESSION['nickname'];
$id=$_SESSION['userid'];
include("../DataProcess/AccountInfo/Account.php");
$account=new Account($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
$list=$account->getMyfollowDetais();
?>
<?PHP session_write_close(); ?>
<body>
<div id="main">
<header style="text-align:center">邀请好友</header>
    <table style="margin-bottom:15px;width:100%;height:100%;word-break:break-all;"cellspacing="0" cellpadding="0"border="1">
        <tr>
            <td width="30%">好友昵称</td>
            <td>
                <select   id="logo" name="exp" onchange="showlogo()"><?PHP foreach($list as $item){
                        $temp=new Account($item['friendid'],'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
                        $nickname=$temp->getNick();
                        $picid=$temp->getPicId();
                        $value=$picid.'_'.$item['friendid'];
                        ?>
                        <option value =<?PHP echo($value) ?> name='<?PHP echo $picid; ?>' ><?PHP echo ($nickname)?></option>
                    <?PHP } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td width="30%">好友头像</td>
            <td> <img name="img"  width="30px" height="30px"></td>
        </tr>
        <tr>
            <td width="30%">时间</td>
            <td ><?PHP echo $date ?><input type="text" style="display:none" name="time" value=<?PHP echo $date ?>></td>
        </tr>
    </table>
    <input  type="button" value="邀请" onclick="invite()" style="float:right">
    </div>
<script type="text/javascript">
    urlinfo=decodeURI(window.location.href);  //获取当前页面的url
    len=urlinfo.length;//获取url的长度
    offset=urlinfo.indexOf("?");//设置参数字符串开始的位置
    newsidinfo=urlinfo.substr(offset,len)//取出参数字符串 这里会获得类似“id=1”这样的字符串
    newsids=newsidinfo.split("=");//对获得的参数字符串按照“=”进行分割
    newsid=newsids[1];//得到参数值
    value=document.getElementById('logo').value.split('_');
    document.images.img.src='../headpics/'+value[0]+'.gif';
    function showlogo(){
        value2=document.getElementById('logo').value.split('_');
        document.images.img.src='../headpics/'+value2[0]+'.gif';
    }

    function invite()
    {

        value2=document.getElementById('logo').value.split('_');
        str=newsid+'-'+value2[1];
        xmlHttp=GetXmlHttpObject()
        if (xmlHttp==null)
        {
            alert ("Browser does not support HTTP Request")
            return
        }
        var url="../DataProcess/GameInfo/Invite.php"
        url=url+"?q="+str
        url=url+"&sid="+Math.random()
        xmlHttp.onreadystatechange=function(){
            if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
            {
                  alert(xmlHttp.responseText);
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
        opener.location.reload();

    }

</script>
</body>
</html>