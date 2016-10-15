<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/15
 * Time: 22:12
 */
$db = new PDO("sqlite:mydatabase.sqlite");
$result=$db->query("select * from users")->fetchAll();
echo $result[1]["password"];