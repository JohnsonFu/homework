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

  public  function getLevel(){
        return $this->infolist['level'];
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
        $res2=$this->getFriend();
        for($i=0;$i<count($arr1);$i++){
            for($j=0;$j<count($res2);$j++){
                if($arr1[$i]==$res2[$j]){
                    array_splice($arr1,$i,1);
                }
            }
        }
        return $arr1;
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
        $result=$this->db->query("select * from mail where tid='$this->id' or fid='$this->id'")->fetchAll();
        return $result;
    }
    public function getReplyMail($mid){
        $result=$this->db->query("select * from replymail where mid='$mid'")->fetchAll();
        return $result;
    }

}


//$db=new PDO('sqlite:mydatabase.sqlite');
//$db->exec("PRAGMA foreign_keys=ON");
//$result=$db->query("insert into comment(pid,masterid)values('599d99','222d22')");
//echo $result;
//$account=new Account('22222','sqlite:mydatabase.sqlite');
//$res1=$account->getMyFollowPosts();
//echo $res1[0]['tittle'];
//$account->hasThumb('1018');