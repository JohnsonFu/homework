<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../css/radialindicator.css"  rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../GamePage/gamecss.css">
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
include('../DataProcess/AccountInfo/Account.php');
$account=new Account($id,$dbaddr);
$walkpath=$account->getWalkPath();
$runpath=$account->getRunPath();
$height=$account->getHeight();
$latestweight=$sport->getLatestWeight();
$height2=$height/100;
$bmi=$latestweight/$height2;
$bmi=round($bmi/$height2,1);
$idealweight=$account->getIdealWeight();
$sport->ImportXMLDATA('../DataProcess/SportXML/test.xml');
$advice=$sport->WeightAdvice($latestweight,$idealweight);
$bmiinfo=$sport->getBMIAnlysis($bmi);
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
            <li><a href="MySport.php">我的运动</a></li>
            <li><a href="SetGoal.php">设定目标</a></li>
            <li><a href="health.php" style="color:#daddf0; background-color: #80c3f7;">身体分析</a></li>
            <li><a href="#">睡眠分析</a></li>
        </ul>
    </div>
</div>

<div id="content">
    <div class="insidecontent">
        <div class="mylabel" style="padding-top:10px;">身体分析</div><hr style="margin-right: 50px;">
        <label style="margin-top:0; font-family:微软雅黑;font-size:20px;color:#000000;">体重变化趋势</label>
        <div id="main" style="width: 600px;height:350px;"></div>
        <label style="font-family:微软雅黑;margin-top:0; font-family:微软雅黑;font-size:20px;color:#000000;">根据身高&nbsp;<?PHP echo $height ?>&nbsp;计算</label>
        <label style="font-size:18px;margin-left:0;color:#55555c;font-family: 微软雅黑;">走路步长:</label>
        <label style="font-family:微软雅黑;font-size:35px; color:black;"><?PHP echo $walkpath; ?></label><label style="font-family:微软雅黑;color:#484848;">厘米</label>
        <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
        <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">跑步步长:</label>
        <label style="font-family:微软雅黑;font-size:35px; color:black;"><?PHP echo $runpath; ?></label><label style="font-family:微软雅黑;color:#484848;">厘米</label>
        <br>
       <img src="../img/bar.png" width="300px" height="38px">
        <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">体重:</label>
        <label style="font-family:微软雅黑;font-size:35px; color:black;"><?PHP echo $latestweight.'Kg'; ?></label>
        <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
        <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">BMI:</label>
        <label style="font-family:微软雅黑;font-size:35px; color:black;"><?PHP echo $bmi; ?></label><br>
       <div style="width:90%;height:80px;margin-bottom:20px;background-color: #ebebeb">
        <div style="padding-right:10px;padding-top:10px;padding-left:10px; font-family:微软雅黑;font-size:20px;color:#000000;"><?PHP echo $bmiinfo; ?>&nbsp;&nbsp;&nbsp你的理想体重<label style="font-size:26px;"><?PHP echo $idealweight?></label>Kg
        <?PHP echo $advice; ?>
        </div><br>
       </div>

    </div>
</div>
</div>



<script src="../js/echarts.min.js" type="text/javascript"></script>

<script src="../jquery-1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));
    var date=[];
    var min;
    var max;
    var weights=[];
    function arrTest(){
        $.ajax({
            type: "post",
            async: false, //同步执行
            url: "../DataProcess/SportInfo/getWeightData.php",
            dataType: "json", //返回数据形式为json
            success: function(result) {

                myChart.hideLoading(); //隐藏加载动画
                for (var i = 0; i < result.length; i++) {
                    var time=result[i].date.split('-');
                    var times=time[1]+'/'+time[2];

                    date.push(times);
                    weights.push(Math.round(result[i].weight));

                }
               min= Math.min.apply(null, weights)
                max=Math.max.apply(null, weights)

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
            data:['体重']
        },
        xAxis: [
            {
                type: 'category',
                axisTick: {
                    alignWithLabel: true
                },
                data: date,

            }
        ],
        yAxis: [

            {
                type: 'value',
                name: '体重',
                min: min-10,
                max: max+10,
                position: 'left',
                axisLine: {
                    lineStyle: {
                        color: colors[2]
                    }
                },
                axisLabel: {
                    formatter: '{value} kg'
                }
            }
        ],

        series: [

            {
                name:'体重',
                type:'line',
                data:weights,
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

        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>

</body>



</html>