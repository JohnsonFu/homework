<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/19
 * Time: 18:17
 */
class mygame
{
public $id;

    private $owngame;
    public $joingame;
    public $db;
    public $allgame;
    function __construct($addr,$id)
    {
        $this->db=new PDO($addr);
        $this->id=$id;
    }
     function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db=null;
    }
    public function getowngame(){
      $result=$this->db->query("select * from game where masterid='$this->id'");
        if($result){
            return $result->fetchAll();
        }else{
            return null;
        }
    }
    public function getgamejoiner($gameid){
        $result=$this->db->query("select joinerid from gamejoiner where gameid='$gameid'")->fetchAll();
        return $result;

    }


    public function getJoinerRankInfo($gameid){
        $result=$this->db->query("select * from users where id in (select joinerid from gamejoiner where gameid='$gameid')")->fetchAll();
        $game=$this->db->query("select * from game where id='$gameid'")->fetchAll()[0];
        $starttime=$game['starttime'];
        $endtime=$game['endtime'];
        $arr=array();
        foreach ($result as $item) {
            $tablename=$item['id'].'data';
            $totalkm=$this->db->query("select sum(km) from '$tablename' where date>='$starttime' and date<='$endtime'")->fetchAll()[0][0];
            $single['nickname']=$item['nickname'];
            $single['id']=$item['id'];
            $single['totalkm']=$totalkm;
            $single['picid']=$item['picid'];
            array_push($arr,$single);
        }
       $res=arra_sort($arr,'totalkm','j');
        return $res;
    }

    public function GameOver($gameid){
        $time =time()+8*60*60;
        $date="20".date("y-m-d",$time);
        $result=$this->db->query("select * from game where id='$gameid' and endtime<'$date' and issettle='0'")->fetchAll();
        $count=count($result);
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function isSettle($gameid){
        $result=$this->db->query("select * from game where id='$gameid' and issettle='1'")->fetchAll();
        $count=count($result);
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function getjoinerInfo($gameid){
        $result=$this->db->query("select * from users where id in (select joinerid from gamejoiner where gameid='$gameid')")->fetchAll();

        return $result;
    }
    public function getGame($gameid){
        $result=$this->db->query("select * from game where id='$gameid'")->fetchAll()[0];
        return $result;
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
