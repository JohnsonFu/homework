<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/15
 * Time: 15:36
 */


$db = new PDO("sqlite:mydatabase.sqlite"); //注意红字部分的路径格式，这样写会报错：new PDO('myDB.sqlite');
if ($db){
    echo 'connect ok';
}else{
    echo 'connect bad';
}

foreach ($db->query("SELECT name FROM test;") as $row)
{
    echo "$row[0]";
}
