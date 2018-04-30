<?php
require_once 'Db.php';

/* Определение чёт/нечёт недели */
$curr = date_create_from_format('d.m.Y', date('d.m.Y'));
$base = date_create_from_format('d.m.Y', '26.02.2018');

$weeks = date_format($curr, 'W') - date_format($base, 'W') ;
$weeks++;

// Костыль для дат после нового года
$weeks = ( $weeks < 0 ) ? $weeks + 52 : $weeks ;
$w = array("четная", "нечетная");

// echo "debug mode<br>site version 2.1";

/* Вывод даты */

function showDate(){
    global $date;
    switch (date("N")) {
        case 1: echo "Понедельник"; break;
        case 2: echo "Вторник"; break;
        case 3: echo "Среда"; break;
        case 4: echo "Четверг"; break;
        case 5: echo "Пятница"; break;
        case 6: echo "Суббота"; break;
        case 7: echo "Воскресение"; break;
    }
    echo date(", j ");
    switch (date("n")){
        case 1: echo "января"; break;
        case 2: echo "февраля"; break;
        case 3: echo "марта"; break;
        case 4: echo "апреля"; break;
        case 5: echo "мая"; break;
        case 6: echo "июня"; break;
        case 7: echo "июля"; break;
        case 8: echo "августа"; break;
        case 9: echo "сентября"; break;
        case 10: echo "октября"; break;
        case 11: echo "ноября"; break;
        case 12: echo "декабря"; break;
    }

    global $w, $weeks;
    echo ", ".$w[$weeks % 2]." неделя (" . $weeks . '-я неделя)' ;
}


function getWeek(){
    if($GLOBALS['weeks'] % 2) {
        $weektype = 1;
    }
    else{
            $weektype = 2;
        }
        return $weektype;
    }


        function showLessonsToday(){
            global $pdo;
            $weektype = getWeek();
            $day = date('N');
//            $stmt = $pdo->query("SELECT name, type, room, teacher FROM schedule WHERE week_number IN($weektype, 0) and week_day = $day");
            $sql = "SELECT name, type, room, teacher FROM schedule WHERE week_number IN($weektype, 0) and week_day = $day ORDER BY lesson_number";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while($result = $stmt->fetch()) {
                echo '
        <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <div class="card-body">
                        <p class="card-text"><b>' . $result['name'] . '</b> - ' . $result['room'] . '<br/></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">' . $result['type'] . '</button>
                            </div>
                            <small class="text-muted"><b>' . $result['teacher'] .  '</b></small>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                ';
            }
    }

//Отображает рассписание на неделю на нечётной неделе
    function showLessonsWeekOdd()
    {
        global $pdo;
        $stmt_monday = $pdo->query("SELECT name, type, room, teacher, week_day, lesson_number FROM schedule WHERE week_number IN(1,0) ORDER BY week_day, lesson_number");
        while($result = $stmt_monday->fetch()) {

            echo '<div class="container">';

            if ($result['week_day'] == '1' && $result['lesson_number']) {
                echo '<div class="pair"><b>Понедельник - ' . $result['lesson_number'] . ' пара:</b></div>';
            }
            elseif ($result['week_day'] == '2' && $result['lesson_number']){
                echo '<div class="pair"><b>Вторник - ' . $result['lesson_number'] . ' пара:</b></div>';
            }
            elseif ($result['week_day'] == '3' && $result['lesson_number']){
                echo '<div class="pair"><b>Среда - ' . $result['lesson_number'] . ' пара:</b></div>';
            }
            elseif ($result['week_day'] == '4' && $result['lesson_number']){
                echo '<div class="pair"><b>Четверг - ' . $result['lesson_number'] . ' пара:</b></div>';
            }
            elseif ($result['week_day'] == '5' && $result['lesson_number']){
                echo '<div class="pair"><b>Пятница - ' . $result['lesson_number'] . ' пара:</b></div>';
            }


        echo '<div class="row">
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                  
                        <p class="card-text"><b>' . $result['name'] . '</b> - ' . $result['room'] . '<br/></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">' . $result['type'] . '</button>
                            </div>
                            <small class="text-muted"><b>' . $result['teacher'] . '</b></small>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
        }
    }

//Отображает рассписание на неделю на чётной неделе
function showLessonsWeekEven()
{
    global $pdo;
    $stmt_monday = $pdo->query("SELECT name, type, room, teacher, week_day, lesson_number FROM schedule WHERE week_number IN(2,0) ORDER BY week_day, lesson_number");
    while ($result = $stmt_monday->fetch()) {

        echo '<div class="container">';

        if ($result['week_day'] == '1' && $result['lesson_number']) {
            echo '<div class="pair"><b>Понедельник - ' . $result['lesson_number'] . ' пара:</b></div>';
        } elseif ($result['week_day'] == '2' && $result['lesson_number']) {
            echo '<div class="pair"><b>Вторник - ' . $result['lesson_number'] . ' пара:</b></div>';
        } elseif ($result['week_day'] == '3' && $result['lesson_number']) {
            echo '<div class="pair"><b>Среда - ' . $result['lesson_number'] . ' пара:</b></div>';
        } elseif ($result['week_day'] == '4' && $result['lesson_number']) {
            echo '<div class="pair"><b>Четверг - ' . $result['lesson_number'] . ' пара:</b></div>';
        } elseif ($result['week_day'] == '5' && $result['lesson_number']) {
            echo '<div class="pair"><b>Пятница - ' . $result['lesson_number'] . ' пара:</b></div>';
        }


        echo '<div class="row">
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                  
                        <p class="card-text"><b>' . $result['name'] . '</b> - ' . $result['room'] . '<br/></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">' . $result['type'] . '</button>
                            </div>
                            <small class="text-muted"><b>' . $result['teacher'] . '</b></small>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
    }
}

    function getAnnotations(){
        global $pdo;
    $stmt = $pdo->query('SELECT * FROM schedule GROUP BY name');
    while($result = $stmt->fetch()){
        echo '
        <div class="card mb-4 box-shadow" style="width: 70%; margin-left: 15%">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal" style="text-align: center">' . $result['name'] . '</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
            <form action="?item=addannotation" method="post">
                <input type="text" name="description" class="form-control" placeholder="Введите описание документа" style="width: 80%; margin-left: 10%">
                <input type="text" name="link" class="form-control" placeholder="Введите ссылку на документ" style="width: 80%; margin-left: 10%">
                <input type="hidden" name="id" value="'; echo $result['id'] . '">
                <button type="submit" class="btn btn-lg btn-block btn-primary" style="width: 40%; font-size: 1em; margin-top: 2%; margin-left: 30%;">Добавить</button>
            </form>
        </div>
    </div>
        ';

    }
}

    function addAnnotation(){
    echo $description = $_POST['description'];
    echo $link = $_POST['link'];
    echo $id = $_POST['id'];
//     use CONCAT in sql query
        // for example UPDATE schedule SET link=CONCAT(link,'asdasd') where name='ТКП'
    }

?>