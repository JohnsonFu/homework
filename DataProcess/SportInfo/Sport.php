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
            if((date('w',strtotime($date))==6)){
                $single['weight'] = $weight;
            }else{
                $single['weight'] = 0;
            }

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
//
            }
        }   //  end if
    }


    public function ImportNewData($dataaddr){
        $sql = "CREATE TABLE IF NOT EXISTS '$this->tablename' (
    date DATE NOT NULL PRIMARY KEY,
    weight DOUBLE  ,
    km DOUBLE,
    path DOUBLE,
    duration DOUBLE,
    heat DOUBLE
    )";

        $this->db->query($sql);
        $res=$this->db->query("select * from '$this->tablename'")->fetchAll();

            $this->getNewData($dataaddr);
            $this->db->query("DELETE FROM  '$this->tablename'");


            //  $this->db->query("DELETE FROM  '$this->tablename'");
            $xmldoc = new DOMDocument();
            $xmldoc->load($dataaddr);
            $stu = $xmldoc->getElementsByTagName("item");//直接找到节点name

            foreach ($stu as $item) {
                $date = $item->getElementsByTagName("date")->item(0)->nodeValue;
                $weight = $item->getElementsByTagName("weight")->item(0)->nodeValue;
                $km = $item->getElementsByTagName("km")->item(0)->nodeValue;
                $path = $item->getElementsByTagName("path")->item(0)->nodeValue;
                $duration = $item->getElementsByTagName("duration")->item(0)->nodeValue;
                $heat = $item->getElementsByTagName("heat")->item(0)->nodeValue;
                $sentence = "insert into '$this->tablename'(date,weight,km,path,duration,heat)values('$date','$weight','$km','$path','$duration','$heat')";
                $this->db->query($sentence);
            }

    }



    public function ImportXMLDATA($dataaddr){

     // $this-> getNewData($dataaddr);
        $sql = "CREATE TABLE IF NOT EXISTS '$this->tablename' (
    date DATE NOT NULL PRIMARY KEY,
    weight DOUBLE  ,
    km DOUBLE,
    path DOUBLE,
    duration DOUBLE,
    heat DOUBLE
    )";

        $this->db->query($sql);
        $res=$this->db->query("select * from '$this->tablename'")->fetchAll();
        if(count($res)==0) {
            $this->getNewData($dataaddr);
            $this->db->query("DELETE FROM  '$this->tablename'");


            //  $this->db->query("DELETE FROM  '$this->tablename'");
            $xmldoc = new DOMDocument();
            $xmldoc->load($dataaddr);
            $stu = $xmldoc->getElementsByTagName("item");//直接找到节点name

            foreach ($stu as $item) {
                $date = $item->getElementsByTagName("date")->item(0)->nodeValue;
                $weight = $item->getElementsByTagName("weight")->item(0)->nodeValue;
                $km = $item->getElementsByTagName("km")->item(0)->nodeValue;
                $path = $item->getElementsByTagName("path")->item(0)->nodeValue;
                $duration = $item->getElementsByTagName("duration")->item(0)->nodeValue;
                $heat = $item->getElementsByTagName("heat")->item(0)->nodeValue;
                $sentence = "insert into '$this->tablename'(date,weight,km,path,duration,heat)values('$date','$weight','$km','$path','$duration','$heat')";
                $this->db->query($sentence);
            }
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

    public function WeightAdvice($nowweight,$ideaweight){
        if(abs($nowweight-$ideaweight)<1){
            return ",与现体重基本一致,希望继续保持!";
        }
        else {
            if ($nowweight > $ideaweight) {
                $cal = ($nowweight - $ideaweight) * 7760;
                return (",还需要燃烧热量".$cal."大卡,为了好身材,努力吧!");
            }
           if($nowweight < $ideaweight){
               $cal = ($ideaweight - $nowweight) * 7760;
               return (",还需要摄入热量".$cal."大卡,注意加强营养,合理搭配膳食!");
           }
        }

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



    public function getWeightData(){
        $sql=("select * from '$this->tablename'");
        $result=$this->db->query($sql)->fetchAll();
        $arr=array();
        foreach ($result as $item) {
            if((date('w',strtotime($item['date']))==6)){
                array_push($arr,$item);
            }
        }
        return $arr;
    }
    public function getLatestWeight(){
        $sql=("select * from '$this->tablename'");
        $result=$this->db->query($sql)->fetchAll();
        $arr=array();
        $count=count($result);
        for($j=$count-1;$j>0;$j--){
            if((date('w',strtotime($result[$j]['date']))==6)){
                return $result[$j]['weight'];
            }
        }
        return null;
    }
    public function getGoal(){
        $goal=$this->db->query("select * from goal where uid='$this->id' ")->fetchAll();
        $arr=array();
        if(count($goal)==0){
            array_push($arr,'无');
            array_push($arr,'无');
            return $arr;
        }else{
            if($goal[0]['type']=='distance'){
                array_push($arr,'运动距离');
                array_push($arr,$goal[0]['nums'].'KM');
            }
            if($goal[0]['type']=='walk'){
                array_push($arr,'运动步数');
                array_push($arr,round($goal[0]['nums'],0).'步');
            }

            return $arr;
        }
    }
    public function getBMIAnlysis($num){
        if($num<18.5){
            return 'BMI分析:体重过轻!';
        }
        if($num>=18.5&&$num<=25){
            return 'BMI分析:体重正常.';
        }
        if($num>25&&$num<=28){
            return 'BMI分析:体重过重!';
        }
        if($num>28&&$num<32){
            return 'BMI分析:肥胖!';
        }
        if($num>=32){
            return 'BMI分析:非常肥胖!';
        }


    }

    public function FollowingSort($users){
        $arr=array();
        $count=0;
        foreach($users as $item){
            $tablename=$item['id'].'data';
            $name=$item['nickname'];
            $pic=$item['picid'];
            $result=$this->db->query("select * from '$tablename'");
            if($result&&$count<10){
                $count++;
                $totalkm=0;
                $totalpath=0;
              //  $rowid=$this->db->query("select max(rowid) from '$tablename'");
                $total=$this->db->query("select * from '$tablename' order by rowid desc ")->fetchAll();
                for($j=0;$j<31;$j++){
                    $totalkm+=$total[$j]['km'];
                    $totalpath+=$total[$j]['path'];
                }

                $single['nick']=$name;
                $single['picid']=$pic;
                $single['km']=$totalkm;
                $single['path']=round($totalpath,0);
                array_push($arr,$single);
            }

        }

        return $arr;
    }

    public function datasort(){
        $users=$this->db->query("select * from 'users'")->fetchAll();
        $arr=array();
        $count=0;
        foreach($users as $item){
            $tablename=$item['id'].'data';
            $name=$item['nickname'];
            $pic=$item['picid'];
            $result=$this->db->query("select * from '$tablename'");
            if($result&&$count<10){
                $count++;
                $totalkm=$this->db->query("select sum(km) from '$tablename'")->fetchAll()[0][0];
                $totalpath=$this->db->query("select sum(path) from '$tablename'")->fetchAll()[0][0];
                $single['nick']=$name;
                $single['picid']=$pic;
                $single['km']=$totalkm;
                $single['path']=round($totalpath,0);
                array_push($arr,$single);
            }

        }

        return $arr;
    }

    public function getPathSort(){
        $arr=$this->datasort();
        $arr2=arra_sort($arr,'path','j');
        return $arr2;
    }

    public function getKmSort(){
        $arr=$this->datasort();
        $arr2=arra_sort($arr,'km','j');
        return $arr2;
    }


    public function getFollowPathSort($users){
        $arr=$this->FollowingSort($users);
        $arr2=arra_sort($arr,'path','j');
        return $arr2;
    }

    public function getFollowKmSort($users){
        $arr=$this->FollowingSort($users);
        $arr2=arra_sort($arr,'km','j');
        return $arr2;
    }




    public function getGoalData($userid){
        $sql=("select * from '$this->tablename'");
        $result=$this->db->query($sql)->fetchAll();
        $count=count($result)-1;
        $path=$result[$count]['path'];
        $km=$result[$count]['km'];
        $arr=array();
        $goal=$this->db->query("select * from goal where uid='$userid' ")->fetchAll();
        if(count($goal)==0){
            array_push($arr,'no');
            array_push($arr,0);
            array_push($arr,0);
            return $arr;

        }else{
            $goalnums=$goal[0]['nums'];
            if($goal[0]['type']=='distance'){
            array_push($arr,'distance');
                array_push($arr,$km);
                array_push($arr,$goalnums);

                return $arr;
            }else{
                array_push($arr,'path');
                array_push($arr,round($path,0));
                array_push($arr,round($goalnums,0));

                return $arr;
            }
        }
    }


}


function arra_sort($arr,$keys,$type){
    $keysvalue = $new_array = array();
    foreach ($arr as $k=>$v){
        $keysvalue[$k] = $v[$keys];
    }
    if($type=='s') {
        asort($keysvalue);
    }
    if($type=='j') {
        arsort($keysvalue);
    }
    foreach ($keysvalue as $k=>$v){
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}
//$sport=new Sport('22222','sqlite:../AccountInfo/mydatabase.sqlite');
//$total=$sport->getGoalData('22222');
//echo $total[1];
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