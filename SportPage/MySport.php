<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../css/radialindicator.css"  rel="stylesheet" type="text/css" />
 <link rel="stylesheet" type="text/css" href="../AccountPage/AccountCss.css">
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
<?PHP
session_start();
$id=$_SESSION['userid'];
$dbaddr='sqlite:../DataProcess/AccountInfo/mydatabase.sqlite';
include('../DataProcess/SportInfo/Sport.php');
$sport=new Sport($id,$dbaddr);
$sport->ImportXMLDATA('../DataProcess/SportXML/test.xml');
$long=$sport->getNearMonthKM();
$time=$sport->getNearMonthTime();
$path=$sport->getNearMonthPath();
$heat=$sport->getNearMonthHeat();
session_write_close();
?>
<body>
<div id="top_bg">
    <div class="logo_l"></div>
    <div id="menu">
        <ul >
            <li><a href="../homepage.php">首页</a></li>
            <li><a href="../SportPage/MySport.php" style="color:#9eff9d;">运动</a></li>
            <li><a href="../GamePage/gameboard.php">竞赛</a></li>
            <li><a href="../AccountPage/friend.php">社交</a></li>
            <li><a href="../CirclePage/mycircle.php">朋友圈</a></li>
            <li><a href="../AccountPage/personinfo.php">个人账户</a></li>
            <li><a href="../DataProcess/AccountInfo/Logout.php">退出登录</a></li>
        </ul>
    </div>
</div>
<div id="leftbar">
    <div id="header">健康管理</div>
    <div id="vertmenu">
        <ul>
            <li><a href="MySport.php" style="color:#daddf0; background-color: #80c3f7;">我的运动</a></li>
            <li><a href="SetGoal.php">设定目标</a></li>
            <li><a href="exercise.php">健身追踪</a></li>
            <li><a href="#">睡眠分析</a></li>
        </ul>
    </div>
</div>

<div id="content">
    <div class="insidecontent">
        <div class="mylabel" style="padding-top:10px;">我的运动</div><hr style="margin-right: 50px;">

            <div id="main" style="width: 650px;height:400px;"></div>
            <label style="margin-top:0; font-family:微软雅黑;font-size:20px;color:#000000;">近一个月运动量</label>
            <label style="font-size:18px;margin-left:0;color:#55555c;font-family: 微软雅黑;">运动距离:</label>
            <label style="font-size:35px; color:black;"><?PHP echo $long; ?></label><label style="font-family:微软雅黑;color:#484848;">公里</label>
            <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
            <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动时长:</label>
            <label style="font-size:35px; color:black;"><?PHP echo $time; ?></label><label style="font-family:微软雅黑;color:#484848;">小时</label>
            <br>
            <label style="font-size:18px;margin-left:125px;color:#55555c;font-family: 微软雅黑;">燃烧热量:</label>
            <label style="font-size:35px; color:black;"><?PHP echo $heat; ?></label><label style="font-family:微软雅黑;color:#484848;">卡路里</label>
            <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
            <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动步数:</label>
            <label style="font-size:35px; color:black;"><?PHP echo $path; ?></label><label style="font-family:微软雅黑;color:#484848;">步</label>


    </div>
</div>
</div>



<script src="../js/echarts.min.js" type="text/javascript"></script>

<script src="../jquery-1.8.3/jquery.min.js"></script>
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
            url: "../DataProcess/SportInfo/getAllData.php",
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
        series: [
            {
                name:'运动步数',
                type:'bar',
                data:path
            },
            {
                name:'运动距离',
                type:'line',
                yAxisIndex: 1,
                data:km
            },
            {
                name:'运动热量',
                type:'bar',
                yAxisIndex: 2,
                data:heat
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>


</html>