<?php

$driver = '';
$host = '';
$db_user = '';
$db_name = '';
$db_password = '';
$charset = '';
$option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];


try{
    global $pdo;
    $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset",$db_user,$db_password,$option);
}
catch (Exception $e){
    echo 'Не могу подключиться к базе данных' . $e;
}
