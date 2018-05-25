<?php

$driver = 'mysql';
$host = 'localhost';
$db_user = 'myalex';
$db_name = 'myalex';
$db_password = 'ljF78343298##1!';
$charset = 'utf8';
$option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];


try{
    global $pdo;
    $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset",$db_user,$db_password,$option);
}
catch (Exception $e){
    echo 'Не могу подключиться к базе данных' . $e;
}