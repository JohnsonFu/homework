<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/4
 * Time: 14:20
 */

$xmldoc = new DOMDocument();
//2、加载xml文件(指定要解析哪个xml文件，此时dom树节点就会加载到内存中)
$xmldoc->load("../SportXML/test.xml");
//3、目标：获取第一个学生的名字
$stu = $xmldoc->getElementsByTagName("item");//直接找到节点name

foreach ($stu as $item) {
    $date=$item->getElementsByTagName("date")->item(0)->nodeValue;
    $weight=$item->getElementsByTagName("weight")->item(0)->nodeValue;
    $km=$item->getElementsByTagName("km")->item(0)->nodeValue;
    $path=$item->getElementsByTagName("path")->item(0)->nodeValue;
    $duration=$item->getElementsByTagName("duration")->item(0)->nodeValue;
    $heat=$item->getElementsByTagName("heat")->item(0)->nodeValue;
    echo $date."-".$weight."-".$km."-".$path."-".$duration."-".$heat;
    echo "<br>";
}



//$stu1 = $stu->item(0);// item(1)时，可以取到周瑜
//$sex=$xmldoc->getElementsByTagName("date");
//$sex1= $sex->item(1);
//echo $sex1->nodeValue;
//echo $stu1->nodeValue;