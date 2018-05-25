<?php
include_once '../core/session.php';
if(isset($_SESSION['auth'])){
//    print_r($_SESSION);
    die('Вы уже авторизованы!');

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Вход</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/signin.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="text-center">
<form class="form-signin" action="../core/auth.php" method="post">
    <img class="mb-4" src="../assets/images/logo.png" alt="" width="120" height="120">
    <h1 class="h3 mb-3 font-weight-normal">Вход в аккаунт</h1>
    <label for="inputEmail" class="sr-only">Username</label>
    <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="g-recaptcha" data-sitekey="6Lc451YUAAAAAPvYOHlAIQUxSV0I340bxRrPM7j1"></div>
    <!--    <div class="checkbox mb-3">-->
<!--        <label>-->
<!--            <input type="checkbox" value="remember-me"> Remember me-->
<!--        </label>-->
<!--    </div>-->
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    <p class="mt-5 mb-3 text-muted">&copy; Sasha Yershov 2018</p>
</form>
</body>
</html>
