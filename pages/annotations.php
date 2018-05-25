<?php
include_once 'core/lessons.php';
include_once 'core/session.php';
    //подключаем аннотации если пользователь авторизован
    if ($_GET['item'] == 'annotations') {
        if (isset($_SESSION['auth'])) {
            echo getAnnotations();
        }
        else{
            die();
        }
    }

    //добавляем аннотации если пользователь авторизован
    if ($_GET['item'] == 'addannotation') {
        if (isset($_SESSION['auth'])) {
            addAnnotation();
            header('Location:?item=annotations');
        }
        else{
            die('У вас нет прав на добавление контента');
        }
    }
    ?>
