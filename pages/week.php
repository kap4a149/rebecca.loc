<?php
include_once 'core/lessons.php';
include_once 'core/session.php';

    if ($_GET['item'] == 'week') {
        if(isset($_SESSION['auth'])) {
        //    echo '<a href="?item=week_even" class="btn btn-secondary my-2" style="width: 100px; margin-left: 25%;">Чётная</a>';
//    echo '<a href="?item=week_odd" class="btn btn-secondary my-2" style="width: 100px ">Нечётная</a>';
        echo '<section class="jumbotron1 text-center" style="height: 150px">
            <h1 class="jumbotron-heading">Выбери тип недели</h1>
            <p>
                <a href="?item=week_even" class="btn btn-secondary my-2" style="background: rgba(255,130,238,0.51); color: rgba(89,0,255,0.91); width: 120px;">Чётная</a>
                <a href="?item=week_odd" class="btn btn-secondary my-2" style="background: rgba(255,130,238,0.51); color: rgba(89,0,255,0.91); width: 120px;">Нечётная</a>
            </p>
        </div>
    </section> ';
    }
        else{
            echo 'У вас нет прав на просмотр этой страницы';
        }
}

    if(isset($_SESSION['auth'])) {
        if ($_GET['item'] == 'week_even') {
            showLessonsWeekEven();
        }

        if ($_GET['item'] == 'week_odd') {
            showLessonsWeekOdd();
        }
    }
    else{
    echo 'У вас нет права на просмотр этой страницы.';
    }

//если гет запрос = even открыть
//иначе
//открыть odd
?>