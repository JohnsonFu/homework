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
</head>
<?PHP session_start();
//error_reporting(0);
if(!isset($_SESSION['userid'])){
    echo "<script>alert('未登录!将返回登录界面....');</script>";
    echo "<meta http-equiv='Refresh' content='0;URL=login.html'>";
}
else {
    include('DataProcess/AccountInfo/Account.php');
    $id = $_SESSION['userid'];
    $dbaddr = "sqlite:DataProcess/AccountInfo/mydatabase.sqlite";
    $account = new Account($id, $dbaddr);
    $nickname = $account->getNick();
    $level = $account->getLevel();
    $money = $account->getMoney();
    $sig = $account->getSig();
$picid=$account->getPicId();
$noread=$account->getUnread();
    $password = $account->getPassword();
    $_SESSION['nickname'] = $nickname;
    $_SESSION['sig'] = $sig;
    $_SESSION['password'] = $password;
    $_SESSION['level'] = $level;
    $_SESSION['money'] = $money;
include('DataProcess/SportInfo/Sport.php');
$sport=new Sport($id,$dbaddr);
$sport->ImportXMLDATA('DataProcess/SportXML/test.xml');
$long=$sport->getTotalKM();
$time=$sport->getTotalTime();
$path=$sport->getTotalPath();
$heat=$sport->getTotalHeat();
$quanshu=$sport->getCircle($long*1000);
session_write_close();
?>
<body>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul >
            <li><a href="#"style="color:#9eff9d;">首页</a></li>
            <li><a href="SportPage/MySport.php">运动</a></li>
            <li><a href="GamePage/gameboard.php">竞赛</a></li>
            <li><a href="AccountPage/friend.php">社交</a></li>
            <li><a href="CirclePage/mycircle.php">朋友圈</a></li>
            <li><a href="AccountPage/personinfo.php">个人账户</a></li>
            <li><a href="DataProcess/AccountInfo/Logout.php">退出登录</a></li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div align="center" class="infobar" >
        <label>用户名:<?PHP echo $nickname ?></label><br>
        <img src="headpics/<?PHP echo($picid); ?>.gif"  alt="找不到头像" /><br>
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
            <li style="margin-top:10px;"><a href="AccountPage/friend.php">我的好友</a></li>
            <li style="margin-top:10px;"><a href="#">我的活动</a></li>
            <?PHP if($noread!=0){?>
            <li style="margin-top:10px;font-size:18px;"><a href="AccountPage/mail.php">邮箱(<?PHP echo $noread.'未读'; ?>)</a></li>
       <?PHP }else{ ?>
            <li style="margin-top:10px;"><a href="AccountPage/mail.php">邮箱</a></li>
<?PHP } ?>
        </ul>
    </div>
</div>
<div id="content">
    <div class="insidecontent">
        <div class="mylabel">运动轨迹</div><hr style="margin-right: 50px;">

            <div id="main" style="width: 640px;height:350px;"></div>

            <label style="margin-top:0; font-family:微软雅黑;font-size:20px;color:#000000;">累计运动总量</label>
            <label style="font-size:18px;margin-left:0;color:#55555c;font-family: 微软雅黑;">运动距离:</label>
            <label style="font-size:35px; color:black;"><?PHP echo $long; ?></label><label style="font-family:微软雅黑;color:#484848;">公里</label>
            <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
            <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动时长:</label>
            <label style="font-size:35px; color:black;"><?PHP echo $time; ?></label><label style="font-family:微软雅黑;color:#484848;">小时</label>
            <br>
            <label style="font-size:18px;margin-left:125px;color:#55555c;font-family: 微软雅黑;">燃烧热量:</label>
            <label style="font-size:35px; color:black;"><?PHP echo $heat; ?></label><label style="font-family:微软雅黑;color:#484848;">大卡</label>
            <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
            <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动步数:</label>
            <label style="font-size:35px; color:black;"><?PHP echo $path; ?></label><label style="font-family:微软雅黑;color:#484848;">步</label><br>
        <label style="margin-top:10px; font-family:微软雅黑;font-size:20px;color:#000000;">这些运动量可以</label><br>
        <div style="display: inline-block;margin-top:20px;"><img src="img/paodao.png" width="150px" height="100px"><br> <label style="padding-left:20%;font-size:18px;"><?PHP echo $quanshu;?>圈</label></div>
        <div style="display:inline-block;"><img src="img/feirou.png" width="150px" height="100px"><br> <label style="padding-left:30%;font-size:18px;"><?PHP echo round($heat/7700,1) ?>公斤</label></div>
       <div style="display:inline-block;"><img src="img/qiyou.png" width="150px" height="100px"><br> <label style="padding-left:30%;font-size:18px;"><?PHP echo round($heat*1.74/10000,2) ?>升</label></div>
        <div style="display:inline-block;"><img src="img/dengpao.png" width="150px" height="100px"><br> <label style="padding-left:30%;font-size:18px;"><?PHP echo round($heat*4.18*1000/216000,0); ?>小时</label></div>

    </div>

</div>
<?PHP }?>


<script src="jquery-1.8.3/jquery.min.js"></script>
<script src="js/echarts.min.js" type="text/javascript"></script>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));
    var date=[];
    var km=[];
    var path=[];
    var heat=[];
    function arrTest(){
        $.ajax({
            type: "post",
            async: false, //同步执行
            url: "DataProcess/SportInfo/getAllData.php",
            dataType: "json", //返回数据形式为json
            success: function(result) {
                myChart.hideLoading(); //隐藏加载动画
                for (var i = 0; i < result.length; i++) {
                    km.push(result[i].km);
                    var time=result[i].date.split('-');
                    var times=time[1]+'/'+time[2];

                    date.push(times);
                    path.push(Math.round(result[i].path));
                    heat.push(result[i].heat);
                }
            },
            error: function() {
                alert("请求数据失败!");
            }
        });
    }
    arrTest();
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
            data:['运动步数','运动距离','运动热量']
        },
        xAxis: [
            {
                type: 'category',
                axisTick: {
                    alignWithLabel: true
                },
                data: date
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '运动步数',
                position: 'right',
                offset: 80,
                axisLine: {
                    lineStyle: {
                        color: colors[1]
                    }
                },
                axisLabel: {
                    formatter: '{value} '
                }
            },
            {
                type: 'value',
                name: '运动距离',
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
                name: '运动热量',
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
        dataZoom: [
            {   // 这个dataZoom组件，默认控制x轴。
                type: 'slider', // 这个 dataZoom 组件是 slider 型 dataZoom 组件
                start: 90,      // 左边在 10% 的位置。
                end: 100         // 右边在 60% 的位置。
            }
        ],
        series: [
            {
                name:'运动步数',
                type:'bar',
                data:path,
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name: '平均值'}
                    ]
                }
            },
            {
                name:'运动距离',
                type:'line',
                yAxisIndex: 1,
                data:km,
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name: '平均值'}
                    ]
                }
            },
            {
                name:'运动热量',
                type:'bar',
                yAxisIndex: 2,
                data:heat,
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name: '平均值'}
                    ]
                }
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>
</html>>