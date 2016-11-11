<?php

/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/11
 * Time: 23:19
 */
class SingleGame
{
    public $db;
    public $gameid;
    function __construct($db,$gameid)
    {
        $this->db=$db;
        $this->gameid=$gameid;
    }


}