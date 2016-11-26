<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/17
 * Time: 22:22
 */
class Account
{
 public $db;
 public $id;
 public $infolist;

 public function __construct($id,$dbadd){

$this->db= new PDO($dbadd);
    $this->id=$id;
$this->infolist=$this->db->query("select * from users where id='$this->id'")->fetchAll()[0];

}
  public  function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db=null;
    }
  public  function getNick(){
        return $this->infolist['nickname'];
    }
    public function getHeight(){
        return $this->infolist['height'];
    }

    public function getWalkPath(){
    $height=$this->infolist['height'];
    return round($height/2.69,0);
}
    public function getRunPath(){
        $height=$this->infolist['height'];
        return round($height/2.25,0);
    }
    public function getIdealWeight(){
        $height=$this->infolist['height']/100;
        $weight=22*$height*$height;
        return round($weight,1);
    }


  public  function getMoney(){
        return $this->infolist['money'];
    }
  public  function getSig(){
        return $this->infolist['signature'];
    }
    public function getPassword(){
        return $this->infolist['password'];
    }
    public function changeNick($nick){
        $nickcheck=$this->db->query("select count(*) from users where nickname='$nick'")->fetchAll()[0][0];
        if($nickcheck>1){
            return -1;
        }else{
            $res=$this->db->query("update users set nickname='$nick' where id='$this->id'");
            if($res){
                return 1;
            }else{
                return 0;
            }
        }
    }

    public function changePassword($pass){
           $res=$this->db->query("update users set password='$pass' where id='$this->id'");
            if($res){
                return 1;
            }else{
                return 0;
            }
 }
    public function changeSignature($sig){
        $res=$this->db->query("update users set signature='$sig' where id='$this->id'");
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    public function getPicId(){
        return $this->infolist['picid'];
    }
    public function getFriend(){
        $res1=$this->db->query("select * from friend f1 where f1.id='$this->id'")->fetchAll();
        $res2=$this->db->query("select * from friend where friendid='$this->id'")->fetchAll();
        $arr1=array();
        $arr2=array();
        for($i=0;$i<count($res1);$i++){
            $arr1[$i]=$res1[$i]['friendid'];
        }
        for($i=0;$i<count($res2);$i++){
            $arr2[$i]=$res2[$i]['id'];
        }

         $arr=array_intersect($arr1,$arr2);
        $result=array();
        foreach($arr as $item){
            array_push($result,$item);
        }

        return $result;
    }
    public function getMyfollow(){
        $res1=$this->db->query("select * from friend where id='$this->id'")->fetchAll();
        for($i=0;$i<count($res1);$i++){
            $arr1[$i]=$res1[$i]['friendid'];
        }

        return $arr1;
    }
    public function getMyfollowAndMe(){
        $res1=$this->db->query("select * from users where id in (select friendid from friend where id='$this->id')")->fetchAll();
       // $res1=$this->db->query("select * from users u where exists(select friendid  from friend  where id='$this->id' and u.id=friendid  )")->fetchAll();

        $me=$this->db->query("select * from users where id='$this->id'")->fetchAll()[0];
        array_push($res1,$me);
        return $res1;


    }

    public function getFollowme(){
        $res1=$this->db->query("select * from friend where friendid='$this->id'")->fetchAll();
        $arr1=array();
        for($i=0;$i<count($res1);$i++){
            $arr1[$i]=$res1[$i]['id'];
        }
            return $arr1;

    }

    public function deleteFriend($friendid){
        $res1=$this->db->query("delete from friend where id='$this->id' and friendid='$friendid' ");

    }

    public function getAllUsers(){
        $res=$this->db->query("select * from users")->fetchAll();
        return $res;
    }
    public function getMyFollowPosts(){
        $result= $this->db->query("select * from post where exists (select * from friend where post.masterid=friend.friendid and friend.id='$this->id')")->fetchAll();
        return $result;
    }
    public function getMyPosts(){
        $result= $this->db->query("select * from post where masterid='$this->id'")->fetchAll();
        return $result;
    }
    public function isFriend($testid){
        $result=$this->db->query("select * from friend f1 where f1.id='$this->id' and f1.friendid='$testid' and  exists(select * from friend f2 where f2.friendid='$this->id' and f2.id='$testid')")->fetchAll();
    if(count($result)>0){
        return true;
    }else{
        return false;
    }
    }
    public function isJoinGame($gameid){
        $result=$this->db->query("select * from gamejoiner where gameid='$gameid' and joinerid='$this->id'")->fetchAll();
        if(count($result)>0){
            return true;
        }else{
            return false;
        }

    }
    public function getThumb($pid){
        $result=$this->db->query("select * from thumb where pid='$pid'")->fetchAll();
        return $result;
    }
    public function hasThumb($pid){
        $result=$this->db->query("select * from thumb where pid='$pid'and uid='$this->id'")->fetchAll();
       if(count($result)>0)
        return 1;
        else
        return 0;
    }
    public function getMail(){
        $result=$this->db->query("select * from mail where tid='$this->id' or fid='$this->id' order by mid desc ")->fetchAll();
        return $result;
    }
    public function getReplyMail($mid){
        $result=$this->db->query("select * from replymail where mid='$mid'")->fetchAll();
        return $result;
    }
    public function getUnread(){
        $result=$this->db->query("select * from mail where tid='$this->id' and hasread=0")->fetchAll();
        $result2=$this->db->query("select * from replymail where tid='$this->id' and hasread=0")->fetchAll();
        return count($result)+count($result2);
    }
    public function hasSetGoal(){
        $result=$this->db->query("select * from goal where uid='$this->id'")->fetchAll();
        $count=count($result);
        if($count>0){
            return true;
        }else{
            return false;
        }
    }
    public function getGoal(){
        $result=$this->db->query("select * from goal where uid='$this->id'")->fetchAll();
        return $result;
    }
    public function getLevel(){
        $result=$this->db->query("select * from users where id='$this->id'")->fetchAll()[0];
        $exp=$result['baseexp']+$result['gameexp'];
        $level=floor($exp/100);
        return $level;
    }

    public function JoinOK($gameid){
        $time =time()+8*60*60;
        $date="20".date("y-m-d",$time);
        $result=$this->db->query("select * from game where id='$gameid' and endtime>'$date'")->fetchAll();
       $count=count($result);

        if($count>0){
            $temp=$this->db->query("select * from gamejoiner where gameid='$gameid'")->fetchAll();
            $count=count($temp);
            if($result[0]['gametype']=='单人PK' and $count>=2 ){
                return false;
            }else {
                return true;
            }
        }else{
            return false;
        }
        return false;

    }

}


//$db=new PDO('sqlite:mydatabase.sqlite');
//$db->exec("PRAGMA foreign_keys=ON");
//$result=$db->query("insert into comment(pid,masterid)values('599d99','222d22')");
//echo $result;
//$account=new Account('22222','sqlite:mydatabase.sqlite');
//$res=$account->getMyfollowAndMe();
//print_r($res);
//$res1=$account->getMyFollowPosts();
//echo $res1[0]['tittle'];
//$account->hasThumb('1018');