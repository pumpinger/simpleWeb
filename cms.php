<?php
/**
 * Created by PhpStorm.
 * User: @van
 * Date: 2015/7/24
 * Time: 12:26
 */

define('APP_ROOT',dirname($_SERVER['SCRIPT_NAME']));
define('APP_PATH',dirname(__FILE__));  //定义常量



include APP_PATH.'/config.php';   //配置文件

include APP_PATH . '/functions.php';  //常用函数

session_start();
//session_destroy();

$mysqli=connectDB();

if( 'downloadExam' != $_GET['a'] and 'downloadRecord' != $_GET['a'] and empty($_SESSION['user'])){
    include './cms/login.php';
    exit;
}

renderPage($_GET['a']);


$mysqli->close();








