<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/9
 * Time: 20:32
 */
$db_name = 'sqlitetest.db';
//打开sqlite数据库
//echo phpinfo();
$db = new PDO('sqlite:/users/fulinhua/desktop/'.$db_name);
//异常处理

if( !$db ) {
    echo '不能连接SQlite文件：',$db_name,'<br />';
}else{
    echo '成功连接SQlite文件：',$db_name,'<br />';
    $result = $db->query('select username from test');
    if(!$result){
        echo '搜索失败';
        echo '<br />';
    }
    if($result){
        echo '搜索成功';
        echo '<br />';
        foreach($result as $row){
            echo $row[0];
            echo "<br>";
        }
    }
}