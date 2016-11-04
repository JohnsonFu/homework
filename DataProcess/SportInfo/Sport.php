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
    function __construct($id,$dbaddr)
    {
        $this->id=$id;
        $this->db=new PDO($dbaddr);
    }
    public function ImportXMLDATA(){
        $tablename=$this->id.'data' ;
        $sql = "CREATE TABLE IF NOT EXISTS '$tablename' (
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
            $sentence="insert into '$tablename'(date,weight,km,path,duration,heat)values('$date','$weight','$km','$path','$duration','$heat')";
            $this->db->query($sentence);
        }

 }



}
$sport=new Sport('22222','sqlite:../AccountInfo/mydatabase.sqlite');
$sport->ImportXMLDATA();
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