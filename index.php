<?php
//session_start();
//unset($_SESSION['auth']);
//session_destroy();
ini_set('error_reporting', E_ALL); ini_set('display_errors', 1); ini_set('display_startup_errors', 1);


//setcookie('access', '1', time()+60000*10000);
if($_COOKIE['access'] !== '1'){
    die('Новая система совсем скоро. <br /><b>Пары 02.05.2018:</b> <br/> 1. Физкультура<br />2.Численные методы (409ф)<br />3.ТКП (609ф)');
}

//require_once 'pages/signin.php';
require_once 'pages/mainPage.php';
?>
