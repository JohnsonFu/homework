<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的动态</title>
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
$anick=$account->getNick();
    $list=$account->getMyPosts();
}
session_write_close();

?>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul >
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="../SportPage/MySport.php" >运动</a></li>
            <li><a href="../GamePage/gameboard.php">竞赛</a></li>
            <li><a href="../AccountPage/friend.php">社交</a></li>
            <li><a href="#" style="color:#9eff9d;">朋友圈</a></li>
            <li><a href="../AccountPage/personinfo.php" >个人账户</a></li>
            <li><a href="../DataProcess/AccountInfo/Logout.php">退出登录</a></li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <img style="margin-left:32%;" src="../headpics/<?PHP echo($account->getPicId()); ?>.gif"><br>
    <label style="margin-left:36%;font-family:Helvetica;font-size:22px"><?PHP echo($account->getNick()); ?></label>
    <label style="margin-left:36%;font-family:Helvetica;font-size:22px">Level<?PHP echo $account->getLevel(); ?></label>
    <div id="header" style="margin-left:33%;">朋友圈</div>
    <button type="button"  style="margin-left:33%;"  class="login-btn register-btn" id="button" onclick="jump()" style="margin-top:12px;margin-left:0%;width:110px;font-size:20px;">发布状态</button>
    <div id="vertmenu">
        <ul>
            <li><a href="mycircle.php" style="font-size:19px;">关注者动态</a></li>
            <li><a href="owncircle.php" style="font-size:20px; background-color: #80c3f7; ">我的动态</a></li>
        </ul>
    </div>
</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">我的动态</div><hr style="margin-right: 50px;">

        <?PHP foreach($list as $item){
            $a=new Account($item['masterid'],'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
            $fpicid=$a->getPicId();
            $fnickname=$a->getNick();

            ?>
            <table width="92%">

                <tr>
                    <th style="background-color: #eaf2f2;font-size:12px;" rowspan="2"><img src="../headpics/<?PHP echo($fpicid);?>.gif" style="margin:5px 5px 5px 5px"><br><?PHP echo($fnickname); ?></th>
                    <th style="font-size:12px;text-align: left;">标题:<?PHP echo($item['tittle']); ?>&nbsp;&nbsp;&nbsp;&nbsp;时间:<?PHP echo($item['time']); ?><input type="button" name=<?PHP echo($item['postid'])?> onclick="deletecircle(this.name)" value="删除" style="float:right;" ><br>
                        运动距离:5KM&nbsp;&nbsp;&nbsp;postID:<?PHP echo($item['postid'])?></label></th>

                </tr>
                <tr>
                    <td style="width:80%;font-size:16px;"><?PHP echo($item['content']); ?></td>
                </tr>
                <tr style="font-size:16px;"><td style="text-align:center">评论者</td><td style="text-align:center">评论内容</td></tr>
                <?PHP
                $post=new Post($id,'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
                $comments=$post->getComment($item['postid']);
                foreach($comments as $temp){
                    $aa=new Account($temp['masterid'],'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
                    $bb=new Account($temp['toid'],'sqlite:../DataProcess/AccountInfo/mydatabase.sqlite');
                    $tonick=$bb->getNick();
                    $cnick=$aa->getNick();
                    $cpicid=$aa->getPicId();
                    $topicid=$bb->getPicId();
                    $ccontent=$temp['content'];
                    $ctime=$temp['time'];
                    ?>

                    <tr style="font-size:16px;background-color: #f4f4f4">
                        <td style="border-style:none;text-align:center;font-size:12px;"><img src="../headpics/<?PHP echo($cpicid);?>.gif" width="10px;" height="10px" ><?PHP echo($cnick)?>&nbsp;&nbsp;to&nbsp;<img src="../headpics/<?PHP echo($topicid);?>.gif" width="10px;" height="10px"> <?PHP echo($tonick) ?></td>
                        <td style="padding-left:5%;border-style: none"><?PHP echo($ccontent)?><div style="float:right"><?PHP echo($ctime); ?>
                 <?PHP  if($temp['masterid']!=$id){  ?>               <input type="button" name=<?PHP echo $cnick,'-',$temp['masterid'],'-',$item['postid'],'-',$cpicid;  ?>  onclick="comment(this.name)" value="回复" > <?PHP } ?> </div></td></tr>
                    <?PHP
                }
                ?>

                <tr  id="commentbar<?PHP  echo($item['postid']) ?>" style="font-size:12px;visibility: hidden"><td style=""><label id="report<?PHP echo $item['postid'] ?>"></label><label id="pid<?PHP echo $item['postid'] ?>" style="visibility: hidden"></label><input type="text" id="postid<?PHP echo $item['postid'] ?>" style="display: none" "><input type="text" name="toid" style="display: none" value="<?PHP echo($item['masterid']) ?>"></td><td>回复内容<input type="text" id="comments<?PHP echo $item['postid'] ?>"><input type="button" value="提交" onclick="addcomment(<?PHP echo $item['postid'] ?>)" style="float:right;"></td></tr>

            </table>
        <?PHP } unset($list);?>


    </div>
    <script language="javascript">


        function jump(){
            window.location.href="SetCircle.php";
        }
        function comment(i){
            var brr= i.split('-');
            var addr='commentbar'+brr[2];
            if( document.getElementById(addr).style.visibility=="visible"){
                document.getElementById(addr).style.visibility="hidden"
            }
            else  if( document.getElementById(addr).style.visibility=="hidden"){
                document.getElementById(addr).style.visibility="visible"
                var arr= i.split('-');
                document.getElementById('postid'+arr[2]).value=arr[2];
                document.getElementById('pid'+arr[2]).innerHTML=arr[1];
                document.getElementById('report'+arr[2]).innerHTML= 'Reply '+'<img src="../headpics/'+arr[3]+'.gif" width="10px" height="10px">'+arr[0];

            }
        }
        function addcomment(i){
           var toid=document.getElementById('pid'+i).innerHTML;
            var content=document.getElementById('comments'+i).value;
            var postid=document.getElementById('postid'+i).value;
            var str=toid+'-'+content+'-'+postid;


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
            var url="../DataProcess/CircleInfo/ReplyComment.php"
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


      function  deletecircle(str){

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
          var url="../DataProcess/CircleInfo/DeleteCircle.php"
          url=url+"?q="+str
          url=url+"&sid="+Math.random()
          xmlHttp.onreadystatechange=stateChanged1
          xmlHttp.open("GET",url,true)
          xmlHttp.send(null)
      }

        function stateChanged1()
        {
            if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
            {
                alert(xmlHttp.responseText);
                window.location.reload();
            }
        }



    </script>


</body>
</html>