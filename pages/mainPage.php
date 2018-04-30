<? require_once 'core/session.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/images/logo.png">

    <title>Redecca</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/main_page.css" rel="stylesheet">
    <link href="../assets/css/annotations.css" rel="stylesheet">

</head>

<body>

<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
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

            <p class="lead text-muted">Redecca - это новая информационная система для группы AI-163 (в будущем, возможно и других). Почувствуйте производительность и функциональность новой системы пройдя небольшую регистрацию. </p>
            <p>
                <a href="../pages/signup.php" class="btn btn-primary my-2">Регистрация</a>
                <a href="../pages/signin.php" class="btn btn-secondary my-2">Авторизация</a>
            </p>
        </div>
    </section>
    <? endif; ?>

    <?php if(isset($_SESSION['auth'])) : ?>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Привет, <?php echo ucfirst($_SESSION['auth']); ?></h1>

            <p class="lead text-muted">Сайт находится на этапе тестирования. Если в работе сайта заметишь баги, глюки, или есть предложение по улучшению напиши в л.с.  </p>
            <p>
                <a href="?item=today"  class="btn btn-secondary my-2">Расписание на сегодня</a>
                <a href="?item=week" class="btn btn-secondary my-2">Расписание на неделю</a>
                <a href="?item=annotations" class="btn btn-secondary my-2">Аннотации к предметам</a>
                <a href="signin.php" class="btn btn-secondary my-2">Оценивание преподавателей</a>
            </p>
        </div>
    </section>
    <? endif; ?>


    <div div class="block" id = "today"><?php include_once 'today.php'; ?></div>
    <div div class="block" id = "week"><?php include_once 'week.php'; ?></div>
    <div div class="block" id = "annotations"><?php include_once 'annotations.php'; ?></div>


</main>
<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            &copy;Sasha Yershov 2018
        </p>

    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../../../assets/js/vendor/popper.min.js"></script>
<script src="../../../../dist/js/bootstrap.min.js"></script>
<script src="../../../../assets/js/vendor/holder.min.js"></script>





<script>

</script>
</body>
</html>
