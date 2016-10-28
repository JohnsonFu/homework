<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/21
 * Time: 16:01
 */
class Post
{
public $db;
public $masterid;
  function __construct($id,$dbaddr)
  {
      $this->db=new PDO($dbaddr);
      $this->masterid=$id;
  }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db=null;
    }

    public function AddPost($time,$tittle,$content){
        $result=$this->db->query("insert into post(masterid,time,tittle,content)values('$this->masterid','$time','$tittle','$content')");
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function getComment($pid){
        $result=$this->db->query("select * from comment where pid='$pid'")->fetchAll();
        return $result;
    }


}

//$post=new Post("22222",'sqlite:../AccountInfo/mydatabase.sqlite');
//$res=$post->getComment('1009');
//echo($res[0]['content']);

