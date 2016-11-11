<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/5
 * Time: 10:17
 */
//$time =time()+32*60*60;
//$date='20'.date("y-m-d",$time);
//if((date('w',strtotime($date))==6) || (date('w',strtotime($date)) == 0)){
//    echo '你输入的日期是周末';
//}else{
//    echo '当然也不是周末了';
//}


// 输出个别的 cookie
$value = "my cookie value";
setcookie("TestCookie",'fadfad', time()+3600*24);
echo $_COOKIE["TestCookie"];
echo "<br />";
echo "<br />";

// 输出所有 cookie
?>
