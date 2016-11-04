<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/4
 * Time: 15:53
 */
$arr=array();
for($j=0;$j<5;$j++){
    $single=$j+11;
    array_push($arr,$single);
}
exit (json_encode($arr));
