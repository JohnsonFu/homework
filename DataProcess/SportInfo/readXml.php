<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/30
 * Time: 20:15
 */
//$xmldoc = new DOMDocument();
////2、加载xml文件(指定要解析哪个xml文件，此时dom树节点就会加载到内存中)
//$xmldoc->load("data.xml");
////3、目标：获取第一个学生的名字
//$stu = $xmldoc->getElementsByTagName("name");//直接找到节点name
//$stu1 = $stu->item(0);// item(1)时，可以取到周瑜
//$sex=$xmldoc->getElementsByTagName("sex");
//$sex1= $sex->item(1);
//echo $sex1->nodeValue;
//echo $stu1->nodeValue;


$testdata=array();
for($i=0;$i<300;$i++){
    $single=array();
    $time =time()+8*60*60-(300-$i)*24*60*60;
    $date='20'.date("y-m-d",$time);
    $weight=rand(65,75);
    $km=rand(10,30)/10;
    $path=rand(7000,30000);
 $single['date']=$date;
    $single['weight']=$weight;
    $single['km']=$km;
    $single['path']=$path;
    array_push($testdata,$single);
}
//print_r($testdata);

$data_array = array(
    array(
        'title' => 'title1',
        'content' => 'content1',
        'pubdate' => '2009-10-11',
    ),
    array(
        'title' => 'title2',
        'content' => 'content2',
        'pubdate' => '2009-11-11',
    )
);
//  属性数组
$attribute_array = array(
    'title' => array(
        'size' => 1
    )
);
//  创建一个XML文档并设置XML版本和编码。。
$dom=new DomDocument('1.0', 'utf-8');
//  创建根节点
$article = $dom->createElement('article');
$dom->appendchild($article);
foreach ($testdata as $data) {
    $items = $dom->createElement('item');
    $article->appendchild($items);
    create_item($dom, $items, $data, $attribute_array);
}
$dom->save("../test.xml");
function create_item($dom, $item, $data, $attribute) {
    if (is_array($data)) {
        foreach ($data as $key => $val) {
            //  创建元素
            $$key = $dom->createElement($key);
            $item->appendchild($$key);
            //  创建元素值
            $text = $dom->createTextNode($val);
            $$key->appendchild($text);
//            if (isset($attribute[$key])) {
//                //  如果此字段存在相关属性需要设置
//                foreach ($attribute[$key] as $akey => $row) {
//                    //  创建属性节点
//                    $$akey = $dom->createAttribute($akey);
//                    $$key->appendchild($$akey);
//                    // 创建属性值节点
//                    $aval = $dom->createTextNode($row);
//                    $$akey->appendChild($aval);
//                }
//            }   //  end if
        }
    }   //  end if
}   //  end function