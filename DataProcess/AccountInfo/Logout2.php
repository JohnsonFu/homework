<?php
/**
 * Created by PhpStorm.
 * User: fulinhua
 * Date: 2016/11/29
 * Time: 16:51
 */
session_start();
session_destroy();
Header("Location:../../manlogin.html");