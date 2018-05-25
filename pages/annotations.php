<?php include_once 'core/lessons.php'?>
<?php include_once 'core/session.php' ?>

<?php
    if ($_GET['item'] == 'annotations') {
        if (isset($_SESSION['auth'])) {
            echo getAnnotations();
        }
        else{
            die('У вас нет прав на просмотр этой страницы');
        }
    }
    if ($_GET['item'] == 'addannotation') {
        if (isset($_SESSION['auth'])) {
            addAnnotation();
            getAnnotations();
        }
        else{
            die('У вас нет прав на добавление контента');
        }
    }
    ?>