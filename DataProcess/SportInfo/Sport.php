<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/4
 * Time: 14:04
 */
class Sport
{
    public $id;
    public $db;
    public $tablename;
    function __construct($id,$dbaddr)
    {
        $this->id=$id;
        $this->db=new PDO($dbaddr);
        $this->tablename=$this->id.'data' ;
    }


    public function getNewData($xmladdr){
        $testdata = array();
        $pathave = rand(5, 8) / 10;//步长为0.5m-0.8
        for ($i = 0; $i < 300; $i++) {
            $single = array();
            $speed = rand(3, 7);
            $time = time() + 8 * 60 * 60 - (300 - $i) * 24 * 60 * 60;
            $date = '20' . date("y-m-d", $time);
            $weight = rand(65, 75);
            $km = rand(20, 100) / 10;
            $path = round($km * 1000 / $pathave, 0);
            $duration = round($km / $speed * 60, 2);
            $heat = round(65 * $speed * $duration / 60, 3);//卡路里公式:65*每小时速度*小时数
            $single['date'] = $date;
            $single['weight'] = $weight;
            $single['km'] = $km;
            $single['path'] = $path;
            $single['duration'] = $duration;
            $single['heat'] = $heat;
            array_push($testdata, $single);
        }
//print_r($testdata);


//  创建一个XML文档并设置XML版本和编码。。
        $dom = new DomDocument('1.0', 'utf-8');
//  创建根节点
        $article = $dom->createElement('article');
        $dom->appendchild($article);
        foreach ($testdata as $data) {
            $items = $dom->createElement('item');
            $article->appendchild($items);
          $this-> create_item($dom, $items, $data);
        }
        $dom->save($xmladdr);
    }

 public   function create_item($dom, $item, $data) {
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
    }




    public function ImportXMLDATA($dataaddr){

    //  $this-> getNewData($dataaddr);
        $sql = "CREATE TABLE IF NOT EXISTS '$this->tablename' (
    date VARCHAR(30) NOT NULL PRIMARY KEY,
    weight DOUBLE  ,
    km DOUBLE,
    path DOUBLE,
    duration DOUBLE,
    heat DOUBLE
    )";
        $this->db->query($sql);
     //   $this->db->query("DELETE FROM  '$this->tablename'");
        $xmldoc = new DOMDocument();
        $xmldoc->load($dataaddr);
        $stu = $xmldoc->getElementsByTagName("item");//直接找到节点name

        foreach ($stu as $item) {
            $date=$item->getElementsByTagName("date")->item(0)->nodeValue;
            $weight=$item->getElementsByTagName("weight")->item(0)->nodeValue;
            $km=$item->getElementsByTagName("km")->item(0)->nodeValue;
            $path=$item->getElementsByTagName("path")->item(0)->nodeValue;
            $duration=$item->getElementsByTagName("duration")->item(0)->nodeValue;
            $heat=$item->getElementsByTagName("heat")->item(0)->nodeValue;
            $sentence="insert into '$this->tablename'(date,weight,km,path,duration,heat)values('$date','$weight','$km','$path','$duration','$heat')";
            $this->db->query($sentence);
        }
    }

    public function getAllData(){
        $sql=("select * from '$this->tablename'");
        $result=$this->db->query($sql)->fetchAll();
        return $result;
}

    public function getTotalKM(){
            $sql=("select sum(km) as total from '$this->tablename'");
           $result=$this->db->query($sql)->fetchAll();
        return $result[0][0];

    }

    public function getNearMonthKM(){
    $maxid=$this->db->query("select max(rowid) from '$this->tablename' ")->fetchall()[0][0];
    $lower=$maxid-30;

    $sql=("select sum(km) as total from '$this->tablename' where rowid<='$maxid' and rowid>='$lower'");
    $result=$this->db->query($sql)->fetchAll();
    return $result[0][0];
}
    public function getNearMonthPath(){
        $maxid=$this->db->query("select max(rowid) from '$this->tablename' ")->fetchall()[0][0];
        $lower=$maxid-30;

        $sql=("select sum(path) as total from '$this->tablename' where rowid<='$maxid' and rowid>='$lower'");
        $result=$this->db->query($sql)->fetchAll();
        return round($result[0][0],0);
    }

    public function getNearMonthHeat(){
        $maxid=$this->db->query("select max(rowid) from '$this->tablename' ")->fetchall()[0][0];
        $lower=$maxid-30;

        $sql=("select sum(heat) as total from '$this->tablename' where rowid<='$maxid' and rowid>='$lower'");
        $result=$this->db->query($sql)->fetchAll();
        return round($result[0][0],1);
    }
    public function getTotalPath(){
        $sql=("select sum(path) as total from '$this->tablename'");
        $result=$this->db->query($sql)->fetchAll();
        return intval($result[0][0]);
    }
    public function getNearMonthTime(){
        $maxid=$this->db->query("select max(rowid) from '$this->tablename' ")->fetchall()[0][0];
        $lower=$maxid-30;

        $sql=("select sum(duration) as total from '$this->tablename' where rowid<='$maxid' and rowid>='$lower'");
        $result=$this->db->query($sql)->fetchAll();
        return round($result[0][0]/60,1);
    }
    public function getTotalTime(){
        $sql=("select sum(duration) as total from '$this->tablename'");
        $result=$this->db->query($sql)->fetchAll();
        $total=$result[0][0];
        $hour=$total/60;
        return round($hour,1);
    }
    public function getTotalHeat(){
        $sql=("select sum(heat) as total from '$this->tablename'");
        $result=$this->db->query($sql)->fetchAll();
        $total=$result[0][0];

        return round($total,1);
    }
    public function getCircle($length){
        return round($length/400,1);
    }



}
//$sport=new Sport('22222','sqlite:../AccountInfo/mydatabase.sqlite');
//$total=$sport->getNewData();
//echo $total;
//$sql = 'CREATE TABLE  tt (
//    date VARCHAR(30) NOT NULL PRIMARY KEY,
//    weight DOUBLE,
//    km DOUBLE,
//    path DOUBLE,
//    duration DOUBLE,
//    heat DOUBLE
//    )';
//$dbh=new PDO('sqlite:../AccountInfo/mydatabase.sqlite');
//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$dbh->exec($sql);
//$result=$dbh->query("insert into tally(QID,AID,votes)values('121','122','121')");
//$result=$dbh->query("select * from tally")->fetchAll();
//echo $result[0][0];