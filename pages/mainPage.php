<? require_once 'core/session.php';
?>

<!--при загрузке главной страницы перенаправить на сегоднящние пары-->
<form method="get">
    <input type="hidden" name="item" value="today">
</form>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/images/logo.png">

<!--    переадресация на сегодняшние пары-->

    <title>Redecca</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/main_page.css" rel="stylesheet">
    <link href="../assets/css/annotations.css" rel="stylesheet">
    <link href="../assets/css/exams.css" rel="stylesheet">

</head>

<body>

<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="index.php" class="navbar-brand d-flex align-items-center">
                <img src="../assets/images/logo.png" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></img>
                <strong style="user-select: none;">Redecca</strong>
            </a>
<!--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">-->
<!--                <span class="navbar-toggler-icon"></span>-->
<!--            </button>-->
        </div>
    </div>
</header>

<main role="main">
    <?php if(!isset($_SESSION['auth'])) : ?>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Project REDECCA</h1>

            <p class="lead text-muted">Redecca - это новая информационная система для группы AI-163. Почувствуй производительность и функциональность новой системы прямо сейчас пройдя небольшую регистрацию. </p>
            <p>
                <a href="../pages/signup.php" class="btn btn-primary my-2">Регистрация</a>
                <a href="../pages/signin.php" class="btn btn-secondary my-2">Авторизация</a>
            </p>
        </div>
    </section>
    <? endif; ?>
    <?php
    // require_once 'core/logout.php';
    ?>
    <!-- <a href="?item=logout" class="btn btn-secondary my-2">LogOut</a> -->


    <?php if(isset($_SESSION['auth'])) : ?>
        <? require_once 'core/lessons.php'; ?>
        <?php getVisits();?>
        <?php inputVerify(); ?>
    <section class="jumbotron text-center" style="padding-top: 30px; padding-bottom: 30px;">
        <div class="container">
            <h1 class="jumbotron-heading css-typing"><?php echo showGreeting() . ', '  . ucfirst($_SESSION['auth']); ?></h1>

          <?php endif; ?>
            <?php if($_GET['item'] == 'week') : ?>
            <p class="lead text-muted" style="margin-bottom: 5px;">Выбери тип недели:</p>
            <?php else: ?>
            <p class="lead text-muted" style="margin-bottom: 5px;">Что бы ты хотел(а) узнать?</p>
            <?php endif;?>
            <p>
             <a href="?item=today"  class="btn button">Расписание на сегодня</a>
             <a href="?item=week" class="btn button">Расписание на неделю</a>
                <?php if($_GET['item'] == 'week') : ?>
                <a href="?item=week_even" class="btn button" id="even">Чётная</a>
                <a href="?item=week_odd" class="btn button" id="odd">Нечётная</a>
                <?php endif; ?>
             <a href="?item=annotations" class="btn button">Аннотации к предметам</a>
             <a href="?item=exams" class="btn button">Рассписание экзаменов</a>
            </p>
        </div>
    </section>
    <? endif; ?>


    <div class="block" id = "today"><?php include_once 'today.php'; ?></div>
    <div class="block" id = "week"><?php include_once 'week.php'; ?></div>
    <div class="block" id = "annotations"><?php include_once 'annotations.php'; ?></div>
    <div class="block" id="exams"><?php include_once 'exams.php'; ?></div>


</main>
<footer class="text-muted">
    <div id="teeest"></div>
    <div class="container">
        <p class="float-right">
            <span class="developer">&copy;Sasha Yershov 2018</span>
        </p>
    </div>
</footer>

<!--Подключение jQuery-->
<script src="../assets/js/jquery.js"></script>


<!-- Если сейчас пара идёт - блок мигает жёлтым, если заакончилась - закрашивается в зелёный цвет -->
<script type="text/javascript">
var Date = new Date();
hours = Date.getHours();
minutes = Date.getMinutes();
    function blinkNov(element) {
        var timeId1 = setInterval(function () {
            $(element).css('background', 'orange');
        }, 1000);

        var timeId2 = setInterval(function () {
            $(element).css('background', '#fff');
        }, 2000);
        }

if(hours == '8'){
        blinkNov('#0');
}
if(hours == '9' && minutes<='35'){
        blinkNov('#0');
}

// Мигание на второй паре
if(hours == '9' && minutes>='36'){
    $('#0').css('background', '#47B930');
    blinkNov('#1');
}
if(hours == '10'){
    $('#0').css('background', '#47B930');
    blinkNov('#1');
}
if(hours == '11' && minutes<='25'){
    $('#0').css('background', '#47B930');
    blinkNov('#1');
}

// Мигание на третьей паре
if(hours == '11' && minutes>='26'){
    $('#0').css('background', '#47B930');
    $('#1').css('background', '#47B930');
    blinkNov('#2');
}

if(hours=='12'){
    $('#0').css('background', '#47B930');
    $('#1').css('background', '#47B930');
    blinkNov('#2');
}

if(hours=='13' && minutes<='15'){
    $('#0').css('background', '#47B930');
    $('#1').css('background', '#47B930');
    blinkNov('#2');
}

// Мигание на четвёртой паре
if(hours == '13' && minutes>='16'){
    $('#0').css('background', '#47B930');
    $('#1').css('background', '#47B930');
    $('#2').css('background', '#47B930');
    blinkNov('#3');
}

if(hours=='14'){
    $('#0').css('background', '#47B930');
    $('#1').css('background', '#47B930');
    $('#2').css('background', '#47B930');
    blinkNov('#3');
}

if(hours=='15' && minutes<='5'){
    $('#0').css('background', '#47B930');
    $('#1').css('background', '#47B930');
    $('#2').css('background', '#47B930');
    blinkNov('#3');
    }
</script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../../../assets/js/vendor/popper.min.js"></script>
<script src="../../../../dist/js/bootstrap.min.js"></script>
<script src="../../../../assets/js/vendor/holder.min.js"></script>

</body>
</html>
