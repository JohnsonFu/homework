<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/10/18
 * Time: 19:31
 */
session_start();
session_destroy();
Header("Location:../../login.html");
