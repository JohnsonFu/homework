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
public $id;
  function __construct($id,$dbaddr)
  {
      $this->db=new PDO($dbaddr);
      $this->id=$id;
  }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db=null;
    }

    public function getMyFollowPosts(){
       $result= $this->db->query("select * from post where exists (select * from friend where post.masterid=friend.friendid and $this->id=friend.id)")->fetchAll();
        return $result;
    }

}

