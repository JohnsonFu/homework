<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/10
 * Time: 11:12
 */
include('Sport.php');
$id=$_GET['q'];
$sport=new Sport($id,'sqlite:../AccountInfo/mydatabase.sqlite');
$sport->ImportNewData('../SportXML/test.xml');
echo '最新数据导入成功!';