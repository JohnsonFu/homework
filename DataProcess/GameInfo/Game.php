<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/19
 * Time: 10:59
 */
class Game
{

    public function __construct()
    {
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }


}

function getGameList($addr){
    $db = new PDO($addr);
    $result=$db->query("select * from game order by id desc");
    if(!$result){
        return null;
    }
    else{
        return $result->fetchAll();
    }

}