<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/30
 * Time: 20:15
 */
$xmldoc = new DOMDocument();
//2、加载xml文件(指定要解析哪个xml文件，此时dom树节点就会加载到内存中)
$xmldoc->load("data.xml");
//3、目标：获取第一个学生的名字
$stu = $xmldoc->getElementsByTagName("name");//直接找到节点name
$stu1 = $stu->item(0);// item(1)时，可以取到周瑜
$sex=$xmldoc->getElementsByTagName("sex");
$sex1= $sex->item(1);
echo $sex1->nodeValue;
echo $stu1->nodeValue;