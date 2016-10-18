<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css"
          href="logregis.css"/>
    <link rel="stylesheet" type="text/css" href="GamePage/gamecss.css">
    <style type="text/css">
        .insidecontent2{
            margin-top:15px;
            margin-right:50px;
            height:600px;
            font-size:25px;
            background-color:#eaf2f2;
            border-radius:10px 10px 10px 10px;
        }
    </style>
    <script>
        function menuFix(){
            var self=document.getElementById("menu").getElementsByTagName("li");
            for(var i=0;i<self.length;i++){
                self[i].onmouseover=function(){
                    this.className+=(this.className.length>0?" ":"")+"listshow";
                }
                self[i].onmouseout=function(){
                    this.className=this.className.replace("listshow","");
                }
            }
        }
        window.onload=menuFix;
    </script>
</head>
<?PHP session_start();
include('DataProcess/AccountInfo/Account.php');
$id=$_SESSION['userid'];
$dbaddr="sqlite:DataProcess/AccountInfo/mydatabase.sqlite";
$account= new Account($id,$dbaddr);
$nickname=$account->getNick();
$level=$account->getLevel();
$money=$account->getMoney();
$sig=$account->getSig();
$password=$account->getPassword();
$_SESSION['nickname']=$nickname;
$_SESSION['sig']=$sig;
$_SESSION['password']=$password;
$_SESSION['level']=$level;
$_SESSION['money']=$money;
?>
<body>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul >
            <li><a href="../homepage.html"style="color:#9eff9d;">首页</a></li>
            <li><a href="sport.html">运动</a></li>
            <li><a href="#">竞赛</a></li>
            <li><a href="#">俱乐部</a></li>
            <li><a href="#">朋友圈</a></li>
            <li><a href="AccountPage/personinfo.php">个人账户</a></li>
            <li><a href="DataProcess/AccountInfo/Logout.php">退出登录</a></li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div align="center" class="infobar" >
        <label>用户名:<?PHP echo $nickname ?></label><br>
        <label>等级:Level<?PHP echo $level ?></label><br>
        <label>胜率:</label><br>
        <label>我的金币:<?PHP echo $money ?></label>
        <label>个性签名:</label>
        <textarea style="width:80%; height:60px;  font-family:Helvetica; font-size:15px;text-align:center;resize:none;background-color:#eaf2f2"><?PHP echo $sig ?></textarea>



        <hr>
    </div>
    <div id="vertmenu">
        <ul>
            <li style="margin-top:10px;"><a href="AccountPage/personinfo.php">账户设置</a></li>
            <li style="margin-top:10px;"><a href="gameboard.php">我的好友</a></li>
            <li style="margin-top:10px;"><a href="#">我的活动</a></li>
            <li style="margin-top:10px;"><a href="#">战书</a></li>
            <li style="margin-top:10px;"><a href="#">单人PK</a></li>
            <li style="margin-top:10px;"><a href="#">群体PK</a></li>
        </ul>
    </div>
</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">运动轨迹</div><hr style="margin-right: 50px;">
        <div class="insidecontent2">
            <div id="main" style="width: 600px;height:350px;"></div>

            <label style="margin-top:0; font-family:微软雅黑;font-size:20px;color:#000000;">累计运动总量</label>
            <label style="font-size:18px;margin-left:0;color:#55555c;font-family: 微软雅黑;">运动距离:</label>
            <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">公里</label>
            <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
            <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动时长:</label>
            <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">小时</label>
            <br>
            <label style="font-size:18px;margin-left:125px;color:#55555c;font-family: 微软雅黑;">燃烧热量:</label>
            <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">大卡</label>
            <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
            <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动步数:</label>
            <label style="font-size:35px; color:black;">0</label><label style="font-family:微软雅黑;color:#484848;">步</label>

        </div>
    </div>
</div>



<script src="js/echarts.min.js" type="text/javascript"></script>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var colors = ['#5793f3', '#d14a61', '#675bba'];

    option = {
        color: colors,

        tooltip: {
            trigger: 'axis'
        },
        grid: {
            right: '20%'
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['运动距离','运动时间','运动热量']
        },
        xAxis: [
            {
                type: 'category',
                axisTick: {
                    alignWithLabel: true
                },
                data: ['1月','2月',"3月",'4月','5月','6月','7月','8月','9月','10月','11月','12月']
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '运动距离',
                min: 0,
                max: 250,
                position: 'right',
                axisLine: {
                    lineStyle: {
                        color: colors[0]
                    }
                },
                axisLabel: {
                    formatter: '{value} km'
                }
            },
            {
                type: 'value',
                name: '运动时间',
                min: 0,
                max: 250,
                position: 'right',
                offset: 80,
                axisLine: {
                    lineStyle: {
                        color: colors[1]
                    }
                },
                axisLabel: {
                    formatter: '{value} h'
                }
            },
            {
                type: 'value',
                name: '运动热量',
                min: 0,
                max: 25,
                position: 'left',
                axisLine: {
                    lineStyle: {
                        color: colors[2]
                    }
                },
                axisLabel: {
                    formatter: '{value} cal'
                }
            }
        ],
        series: [
            {
                name:'运动距离',
                type:'bar',
                data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3]
            },
            {
                name:'运动时间',
                type:'bar',
                yAxisIndex: 1,
                data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            },
            {
                name:'运动热量',
                type:'bar',
                yAxisIndex: 2,
                data:[2.0, 2.2, 3.3, 4.5, 6.3, 10.2, 20.3, 23.4, 23.0, 16.5, 12.0, 6.2]
            }
        ]
    };




    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>
</html>>