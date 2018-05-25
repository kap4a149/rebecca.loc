<?php
require_once 'Db.php';
require_once 'session.php';

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
    echo ", ".$w[$weeks % 2]." неделя (" . $weeks . '-я)' ;
}

//Показать приветствие на главной странице в зависимости от времени суток
function showGreeting(){
    $hours = date('G');
    if($hours>=4 && $hours<=10){
        $greeting = 'Доброе утро';
    }
    else if($hours>=11 && $hours<=17){
        $greeting = 'Привет';
    }
    else if($hours>=18 && $hours<=22){
        $greeting = 'Вечер в хату';
    }
    else if($hours==23 || $hours<=4){
        $greeting = 'Доброй ночи';
    }
    return $greeting;
}

//Записать в БД количество посещений сайта
function getVisits(){
    global $pdo;
    $name = $_SESSION['auth'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $sql = 'SELECT visits FROM users WHERE login = :name';
    $options = [':name' => $name];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($options);
    $result = $stmt->fetchColumn();
    //Добавляем + 1 в бд
    $result = $result+1;
    $sql_insert = 'UPDATE users SET visits = :visits, ip=:ip WHERE login = :login';
    $options_insert = [':visits' => $result, ':ip' => $ip, ':login' => $name];
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute($options_insert);

//    echo 'Количество посещений:' . $result;

}

// Проверить чётная сейчас неделя или нет
    function getWeek(){
    if ($GLOBALS['weeks'] % 2) {
       $weektype = 1;
    } else {
    $weektype = 2;
    }
    return $weektype;
    }

    //Для вывода сегодняшних пар
    function getCurrentDay(){
        $day = date('N');
        return $day;
    }

//    Для вывода завтрашних пар, и вывода пар в понедельник
 function getNextDay(){
    $day = date('N');
    $day++;
    if($day == '6' || $day == '7' || $day == '8') {
        $day = 1;
    }
    return $day;
    }

    // Получаем кратность следующей недели
    function getNextWeek(){
    $day = date('N');
    $day++;
    $next = getWeek();
    if($day == '6' || $day == '7' || $day == '8') {
        if ($next == '2'){
    $next = '1';
    }
    else{
    $next = '2';
    }
    }
    return $next;
    }


//    Переход с пятницы на понедельник
    function fromFridayToMonday(){
    $day = date('N');
    $output_value =  'Завтрашние пары:';
    if($day == 6 || $day == 7){
    $output_value =  'Пары в понедельник:';
    }
    return $output_value;
    }


        function showLessonsToday(){
        getNextWeek();
            global $pdo;
            $i = 0;
            $weektype = getWeek();
            if(date('G')<16) {
//            $stmt = $pdo->query("SELECT name, type, room, teacher FROM schedule WHERE week_number IN($weektype, 0) and week_day = $day");
                $sql = "SELECT name, type, room, teacher FROM schedule WHERE week_number IN($weektype, 0) and week_day = " . getCurrentDay() . " ORDER BY lesson_number";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                while ($result = $stmt->fetch()) {
                    echo '
        <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <div class="card-body" id="';  echo $i++ . '">
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

            echo '<p class="lead text-center" style="text-align: center; margin-bottom: 10px;">' . fromFridayToMonday();
            $day_next = date('N + 1');
//            $stmt = $pdo->query("SELECT name, type, room, teacher FROM schedule WHERE week_number IN($weektype, 0) and week_day = $day");
            $sql = "SELECT name, type, room, teacher FROM schedule WHERE week_number IN(" . getNextWeek() . ", 0) and week_day =" . getNextDay() . " ORDER BY lesson_number";
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

//    Отобразить день недели в рассписании на неделю
function showDay($day){
    switch ($day){
        case 1:{
            $day = 'Понедельник';
            break;
        }
        case 2:{
            $day = 'Вторник:';
            break;
        }
        case 3:{
            $day = 'Среда';
            break;
        }
        case 4:{
            $day = 'Четверг';
            break;
        }
        case 5:{
            $day = 'Пятница';
            break;
        }
    }
    return $day;
}

//Отображает рассписание на неделю на нечётной неделе
    function showLessonsWeekOdd()
    {
        global $pdo;
        for($i = 1; $i<= 5; $i++) {
            $stmt_monday = $pdo->query("SELECT name, type, room, teacher, week_day, lesson_number FROM schedule WHERE week_number IN (1,0) AND week_day=" . $i . " ORDER BY week_day, lesson_number");
            $stmt_weekday = $pdo->query("SELECT week_day from schedule WHERE week_day=" .$i);
            $weekday = $stmt_weekday->fetchColumn();
            echo '<div class="container">
            <div class="row">
            <div class="col-md-4">';
            echo '<div class="dayOfWeek">'.showDay($weekday).'</div>
            <div class="card mb-4 box-shadow">';
            while ($result = $stmt_monday->fetch()) {

                echo '<p class="card-text"><b>' . $result['name'] . '</b> - ' . $result['room'] . '<br/></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">' . $result['type'] . '</button>
                            </div>
                            <small class="text-muted"><b>' . $result['teacher'] . '</b></small>
                        </div> <hr class="hrLast">';
            }
            echo '</div>
                </div>
            </div>
        </div>
    </div>
    ';
        }
    }

//Отображает рассписание на неделю на чётной неделе
function showLessonsWeekEven(){
    global $pdo;
    for($i = 1; $i<= 5; $i++) {
        $stmt_monday = $pdo->query("SELECT name, type, room, teacher, week_day, lesson_number FROM schedule WHERE week_number IN (2,0) AND week_day=" . $i . " ORDER BY week_day, lesson_number");
        $stmt_weekday = $pdo->query("SELECT week_day from schedule WHERE week_day=" .$i);
        $weekday = $stmt_weekday->fetchColumn();
        echo '<div class="container">
            <div class="row">
            <div class="col-md-4">';
        echo '<div class="dayOfWeek">'.showDay($weekday).'</div>
            <div class="card mb-4 box-shadow">';
        while ($result = $stmt_monday->fetch()) {

            echo '<p class="card-text"><b>' . $result['name'] . '</b> - ' . $result['room'] . '<br/></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">' . $result['type'] . '</button>
                            </div>
                            <small class="text-muted"><b>' . $result['teacher'] . '</b></small>
                        </div> <hr class="hrLast">';
        }
        echo '</div>
                </div>
            </div>
        </div>
    </div>
    ';
    }
}

    function getAnnotations(){
        echo $_POST['description'] . $_POST['link'] . $_POST['id'];

        global $pdo;
    $stmt = $pdo->query('SELECT * FROM schedule GROUP BY name ORDER BY link DESC');
    while($result = $stmt->fetch()){
        //поиск описания
        preg_match_all("~desc:([^\s]*)~", $result['link'], $description_matches);
        preg_match_all('~lnk:[A-Za-z0-9!@#$%*()\\:-_=///.]*~', $result['link'], $link_matches);
        preg_match_all('~usr:[A-Za-z0-9!@#$%*()\\:-_=///.]*~', $result['link'],$user_matches);
        echo '<div class="col-12 col-lg-4" style="margin-top: 2%; margin-left: auto; margin-right: auto;">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">'; echo $result['name'] . '</h4>
                                    <p class="card-text" style="width: 280px">';
        $i=0;
        while ($i<10){
            if(!empty($description_matches[0][$i])){
                echo '<a target="_blank" style="font-size: 1.1em" href="http://' . str_replace('_', ' ',trim($link_matches[0][$i], ':lnk')) . '">' . trim($description_matches[0][$i], ':desc') . '</a>' . '<small class="text-muted" style="font-size: 0.8em;">/' . trim($user_matches[0][$i],'usr:') . '</small></h1>' . '<br />';
            }
            $i++;
        }

        echo '</p>
        <form action="?item=addannotation" method="post">
                <input type="text" name="description" class="form-control" style="margin-left: -2%;" placeholder="Введите описание документа" required>
                <input type="text" name="link" class="form-control" style="margin-left: -2%;" placeholder="Введите ссылку на документ" required>
                <input type="hidden" name="id" value="'; echo $result['id'] . '">
                <button type="submit" class="btn btn-lg btn-block btn-primary" style="width: 50%; height: 8%; margin-left: 20%;  margin-top: 4%">Добавить</button>
            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }

//            echo '
//            <form action="?item=addannotation" method="post">
//                <input type="text" name="description" class="form-control" placeholder="Введите описание документа" style="width: 80%; margin-left: 10%" required>
//                <input type="text" name="link" class="form-control" placeholder="Введите ссылку на документ" style="width: 80%; margin-left: 10%" required>
//                <input type="hidden" name="id" value="'; echo $result['id'] . '">
//                <button type="submit" class="btn btn-lg btn-block btn-primary" style="width: 40%; font-size: 1em; margin-top: 2%; margin-left: 30%;">Добавить</button>
//            </form>
//        </div>
//    </div>
//        ';
//
//    }
}

    function addAnnotation(){
    global $pdo;
    $description = 'desc:' . str_replace(' ', '_',$_POST['description']) . ' ';
    $link =  'lnk:' . $_POST['link'] . ' ';
    $id = $_POST['id'];
    $username = 'usr:' . str_replace(' ', '_', $_SESSION['auth']) . ' ';

    $sql = 'UPDATE schedule SET link = CONCAT(link, :description, :link, :username) WHERE id=:id';
    $options = [':link' => $link, ':description' => $description, ':username' => $username, ':id' => $id];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($options);
}

//При работе с сайта проверяет существует ли аккаунт
    function inputVerify(){
        global $pdo;
        $login = $_SESSION['auth'];
            $sql = "SELECT login,password FROM users where login = :login;";
                    $params = [':login' => $login];
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($params);
                    $user = $stmt->fetch(PDO::FETCH_OBJ);
                    if(!$user){
                        echo 'Ваш аккаунт удалён _/(О_О)\_';
                        die();
                    }
        }

?>
