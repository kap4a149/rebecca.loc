<?php

$host = 'localhost';
$db_user = 'myalex';
$db_name = 'myalex';
$db_password = '123esRedecca456';


try{
    global $pdo;
    $pdo = new PDO("mysql:host=$host;dbname=$db_name",$db_user,$db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e){
    echo 'Не могу подключиться к базе данных' . $e->getMessage();
}