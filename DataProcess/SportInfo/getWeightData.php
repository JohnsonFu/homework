<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/5
 * Time: 14:04
 */
session_start();
include('../SportInfo/Sport.php');
$id=$_SESSION['userid'];
$dbaddr=
$sport=new Sport($id,'sqlite:../AccountInfo/mydatabase.sqlite');
$data=$sport->getWeightData();

exit(json_encode($data));