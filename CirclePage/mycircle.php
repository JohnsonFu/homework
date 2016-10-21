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
            <img style="margin-left:32%;" src="../headpics/13.gif"><br>
            <label style="margin-left:36%;">且听风吟</label>
        <div id="header" style="margin-left:33%;">朋友圈</div>
        <div id="vertmenu">
        <ul>
        <li><a href="friend.php" style=" color: #daddf0; background-color: #80c3f7;">好友动态</a></li>
        </ul>
        </div>
        </div>
        <div id="content">
        <div class="insidecontent">
        <div class="mylabel">好友动态</div><hr style="margin-right: 50px;">
        <div style="margin-left:53%;"><input type="text" class="textview" name="friendname" placeholder="请输入昵称"><input type="button" class="mybutton" value="搜索">
</div>

 <table>
                <tr>
                    <th style="background-color: #eaf2f2;font-size:12px;" rowspan="2"><img src="../headpics/17.gif" style="margin:5px 5px 5px 5px"><br>且听风吟</th>
                    <th style="font-size:12px;text-align: left;">标题:今天是个好日子&nbsp;&nbsp;&nbsp;&nbsp;时间:2016-10-10&nbsp;&nbsp;14:20<input type="button" value="点赞" style="float:right;"><br>
                        运动距离:5KM&nbsp;&nbsp;&nbsp;朋友圈排名:2<input type="button" value="评论" style="float: right"></th>

                </tr>
                <tr>

                    <td style="width:80%;font-size:16px;">今天在操场跑了五圈,挺累的.</td>
                </tr>

            </table>

            <table>
                <tr>
                    <th style="background-color: #eaf2f2;font-size:12px;" rowspan="2" ><img src="../headpics/18.gif" style="margin:5px 5px 5px 5px"><br>酷炫男孩</th>
                    <th style="font-size:12px;text-align: left;">标题:今天是个好日子&nbsp;&nbsp;&nbsp;&nbsp;时间:2016-10-10&nbsp;&nbsp;14:20<input type="button" value="点赞" style="float:right;"><br>
                        运动距离:5KM&nbsp;&nbsp;&nbsp;朋友圈排名:2<input type="button" value="评论" style="float: right"></th>

                </tr>
                <tr>

                    <td style="width:80%;font-size:16px;">今天在操场跑了五圈,挺累的.</td>
                </tr>

            </table>

            <table>
                <tr>
                    <th style="background-color: #eaf2f2;font-size:12px;" rowspan="2"><img src="../headpics/19.gif" style="margin:5px 5px 5px 5px"><br>跑男</th>
                    <th style="font-size:12px;text-align: left;">标题:今天是个好日子&nbsp;&nbsp;&nbsp;&nbsp;时间:2016-10-10&nbsp;&nbsp;14:20<input type="button" value="点赞" style="float:right;"><br>
                        运动距离:5KM&nbsp;&nbsp;&nbsp;朋友圈排名:2<input type="button" value="评论" style="float: right"></th>

                </tr>
                <tr>

                    <td style="width:80%;font-size:16px;">今天在操场跑了五圈,挺累的.</td>
                </tr>

            </table>
</div>
</body>


</body>
</html>