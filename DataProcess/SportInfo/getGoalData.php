<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/5
 * Time: 19:21
 */
session_start();
include('../SportInfo/Sport.php');
$id=$_SESSION['userid'];
$sport=new Sport($id,'sqlite:../AccountInfo/mydatabase.sqlite');
$data=$sport->getGoalData($id);


exit(json_encode($data));