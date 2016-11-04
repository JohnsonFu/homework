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
    public function ImportXMLDATA(){

        $sql = "CREATE TABLE IF NOT EXISTS '$this->tablename' (
    date VARCHAR(30) NOT NULL PRIMARY KEY,
    weight DOUBLE  ,
    km DOUBLE,
    path DOUBLE,
    duration DOUBLE,
    heat DOUBLE
    )";
        $this->db->query($sql);
        $this->db->exec("truncate table '$this->id'.data");
        $xmldoc = new DOMDocument();
        $xmldoc->load("../SportXML/test.xml");
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
        return round($result[0][0]/1000,1);
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

        return round($total/1000,1);
    }
    public function getCircle($length){
        return round($length/400,1);
    }



}
//$sport=new Sport('22222','sqlite:../AccountInfo/mydatabase.sqlite');
//$total=$sport->getTotalTime();
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