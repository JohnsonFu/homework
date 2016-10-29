<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="GB2312">
    <title>发送私信</title>
</head>
<?PHP
$time =time()+8*60*60;
$date='20'.date("y-m-d H:i",$time);
session_start();
$nick=$_SESSION['nickname'];

?>

<body>
<header style="text-align:center">发送信息</header>
<form action="../DataProcess/MailInfo/sendmail.php" method="post">
<table style="margin-bottom:15px;width:100%;height:100%;word-break:break-all;"cellspacing="0" cellpadding="0"border="1">
    <tr>
        <td width="30%">标题</td>
        <td><input type="text" style="width:40%" placeholder="邮件标题" name="tittle"><input type="text" style="display:none" name="toid"></td>
    </tr>
    <tr>
        <td width="30%">内容</td>
        <td><input name="content" type="text" style="width:80%" placeholder="邮件内容"></td>
    </tr>
    <tr>
        <td width="30%">时间</td>
        <td ><?PHP echo $date ?><input type="text" style="display:none" name="time" value=<?PHP echo $date ?>></td>
    </tr>
</table>
<input  type="submit" value="发送" style="float:right">
    </form>
<script type="text/javascript">
    urlinfo=window.location.href;  //获取当前页面的url
    len=urlinfo.length;//获取url的长度
    offset=urlinfo.indexOf("?");//设置参数字符串开始的位置
    newsidinfo=urlinfo.substr(offset,len)//取出参数字符串 这里会获得类似“id=1”这样的字符串
    newsids=newsidinfo.split("=");//对获得的参数字符串按照“=”进行分割
    newsid=newsids[1];//得到参数值
    document.getElementsByName('toid')[0].value=newsid
</script>
</body>
</html>