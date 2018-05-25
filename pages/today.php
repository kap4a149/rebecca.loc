<div class="album py-5 bg-light">
<?php
    include_once 'core/lessons.php';

//    <!--    Пары сегодня-->
        if ($_GET['item'] == 'today') {
            if(isset($_SESSION['auth'])) {
            echo '<p class="lead text-muted-colored" style="text-align: center;">';
            echo showDate() . '</p>';
            echo showLessonsToday() . '</div>';
        }
        else{
          die('У вас нет прав на просмотр этой страницы 1');
        }
    }
?>
