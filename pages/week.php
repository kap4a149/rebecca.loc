<?php
include_once 'core/lessons.php';
include_once 'core/session.php';

    //Если пользователь авторизован, отобразить рассписание на чётную неделю
    if(isset($_SESSION['auth'])) {
        if ($_GET['item'] == 'week_even') {
            showLessonsWeekEven();
        }


      //Если пользователь авторизован, отобразить рассписание на нечётную неделю
        if ($_GET['item'] == 'week_odd') {
            showLessonsWeekOdd();
        }
    }
    else{
    die();
    }

?>
