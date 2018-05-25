<div class="album bg-light" style="padding-top: 0">
<?php
    include_once 'core/lessons.php';

//    <!--    Пары сегодня-->
        if ($_GET['item'] == 'today' || !isset($_GET['item'])) {
            if(isset($_SESSION['auth'])) {
            echo '<p class="lead text-muted-colored" style="text-align: center; padding-top: 15px; margin-bottom: 15px;">';
            echo showDate() . '</p>';
            echo showLessonsToday() . '</div>';
        }
        else{
          die();
        }
    }
?>
