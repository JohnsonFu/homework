<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../logregis.css"  rel="stylesheet" type="text/css" />
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
include('../DataProcess/AccountInfo/Account.php');
$account=new Account($id,$dbaddr);
$followAndI=$account->getMyfollowAndMe();
$sport=new Sport($id,$dbaddr);
$sport->ImportXMLDATA('../DataProcess/SportXML/test.xml');
$long=$sport->getNearMonthKM();
$time=$sport->getNearMonthTime();
$path=$sport->getNearMonthPath();
$heat=$sport->getNearMonthHeat();
$goal=$sport->getGoal();
$kmrank=$sport->getFollowKmSort($followAndI);
$pathrank=$sport->getFollowPathSort($followAndI);
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
            <li><a href="health.php">身体分析</a></li>
        </ul>
    </div>
</div>

<div id="content">
    <div class="insidecontent">
        <div class="mylabel" style="padding-top:10px;">我的运动</div>
        <button style="margin-top:-50px;margin-bottom:15px;" type="button" name="<?PHP echo $id; ?>"  class="login-btn register-btn" id="button" onclick="loadnew(this.name)">导入最新数据</button>

        <hr style="margin-right: 50px;">

        <div>
        <div id="piechart" style="width: 420px;height:150px;display:inline-block"></div>
            <div style="display:inline-block;margin-top:20px;margin-right:5%;float:right;width:200px;height:150px">
                <label style="font-size:20px;color:#55555c;font-family: 微软雅黑;">目标类型:<?PHP echo $goal[0] ?></label><br>
                <label style="font-size:20px;color:#55555c;font-family: 微软雅黑;">目标数值:<label style="font-size:24px;"><?PHP echo $goal[1] ?></label></label><br>
                <label style="font-size:20px;color:#55555c;font-family: 微软雅黑;">今日成果:<label id="today" style="font-size:24px;">0</label></label>
            </div>
            </div>
            <div id="main" style="width: 650px;height:400px;"></div>
            <label style="margin-top:0; font-family:微软雅黑;font-size:20px;color:#000000;">近一个月运动量</label>
            <label style="font-size:18px;margin-left:0;color:#55555c;font-family: 微软雅黑;">运动距离:</label>
            <label style="font-family:微软雅黑;font-size:35px; color:black;"><?PHP echo $long; ?></label><label style="font-family:微软雅黑;color:#484848;">公里</label>
            <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
            <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动时长:</label>
            <label style="font-family:微软雅黑;font-size:35px; color:black;"><?PHP echo $time; ?></label><label style="font-family:微软雅黑;color:#484848;">小时</label>
            <br>
            <label style="font-size:18px;margin-left:125px;color:#55555c;font-family: 微软雅黑;">燃烧热量:</label>
            <label style="font-family:微软雅黑;font-size:35px; color:black;"><?PHP echo $heat; ?></label><label style="font-family:微软雅黑;color:#484848;">大卡</label>
            <label style="font-family:微软雅黑;font-size:50px; margin-top:20px;color:lightgrey">|</label>
            <label style="font-size:18px;color:#55555c;font-family: 微软雅黑;">运动步数:</label>
            <label style="font-family:微软雅黑;font-size:35px; color:black;"><?PHP echo $path; ?></label><label style="font-family:微软雅黑;color:#484848;">步</label><br>
        <label style="margin-top:10px; font-family:微软雅黑;font-size:20px;color:#000000;">这些运动量可以</label><br>
        <div style="display: inline-block;margin-top:20px;"><img src="../img/paodao.png" width="150px" height="100px"><br> <label style="font-family:微软雅黑;padding-left:20%;font-size:18px;"><?PHP echo round($long*1000/400,1);?>圈</label></div>
        <div style="display:inline-block;"><img src="../img/feirou.png" width="150px" height="100px"><br> <label style="font-family:微软雅黑;padding-left:30%;font-size:18px;"><?PHP echo round($heat/7700,1) ?>公斤</label></div>
        <div style="display:inline-block;"><img src="../img/qiyou.png" width="150px" height="100px"><br> <label style="font-family:微软雅黑;padding-left:30%;font-size:18px;"><?PHP echo round($heat*1.74/10000,2) ?>升</label></div>
        <div style="display:inline-block;"><img src="../img/dengpao.png" width="150px" height="100px"><br> <label style="font-family:微软雅黑;padding-left:30%;font-size:18px;"><?PHP echo round($heat*4.18*1000/216000,0); ?>小时</label></div>
<br>
           <label style="margin-left:35%;font-family:Helvetica;padding-top:20px;">关注者排行(月)</label><br>
        <div style="display:inline-block;width:300px;font-family:Helvetica;">
            <header >距离排行榜</header>
            <?PHP $count=0;
            foreach ($kmrank as $item) {
                $count++;
                echo $count." "; ?>
                <img src="../headpics/<?PHP echo($item['picid']);?>.gif" width="30px" height="30px">
                <?PHP echo $item['nick'].' '.$item['km'].'Km' ?>
                <br>
                <?PHP
            }?>
        </div>

        <div style="display:inline-block;width:300px;float:right;margin-right:50px;font-family:Helvetica;">
            <header>步数排行榜</header>
            <?PHP $count2=0;
            foreach ($pathrank as $item) {
                $count2++;
                echo $count2." "; ?>
                <img src="../headpics/<?PHP echo($item['picid']);?>.gif" width="30px" height="30px">
                <?PHP echo $item['nick'].' '.$item['path'].'步' ?>
                <br>
                <?PHP
            }?>
        </div>


    </div>
</div>
</div>



<script src="../js/echarts.min.js" type="text/javascript"></script>

<script src="../jquery-1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    function loadnew(str){
        // if (str.length==0)
        //{

        //  return
        //}
        xmlHttp=GetXmlHttpObject()
        if (xmlHttp==null)
        {
            alert ("Browser does not support HTTP Request")
            return
        }
        var url="../DataProcess/SportInfo/UpdateData.php"
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
            if(xmlHttp.responseText=='最新数据导入成功!')
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



</script>
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
<script type="text/javascript">
    var myChart2 = echarts.init(document.getElementById('piechart'));
    var goal=0;
    var temp=0;
    function arrTest(){
        $.ajax({
            type: "post",
            async: false, //同步执行
            url: "../DataProcess/SportInfo/getGoalData.php",
            dataType: "json", //返回数据形式为json
            success: function(result) {
                myChart.hideLoading(); //隐藏加载动画
                  if(result[0]=='distance'){
                      temp=result[1];
                      goal=result[2];
                      $("#today").text(temp+'KM');
                  }if(result[0]=='path'){
                      temp=result[1];
                      goal=result[2];
                    $("#today").text(temp+'步');
                  }

            },
            error: function() {
                alert("请求数据失败!");
            }
        });
    }
    arrTest();
    option = {
        title: {
            text: '目标完成情况',
            x: 'center'
        },


        series : [
            {
                name:'目标情况',
                type:'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[

                    {value:temp, name:'完成'},
                    {value:(goal-temp).toFixed(1), name:'未完成'}
                ],
                itemStyle:{
                    normal:{
                        label:{
                            show: true,
                            formatter: '{b} : {c} ({d}%)'
                        },
                        labelLine :{show:true}
                    }
                }
            }
        ]

    };
    myChart2.setOption(option);



</script>
</body>


</html>