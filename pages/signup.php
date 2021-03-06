<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Регистрация</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="../core/register.php" method="post">
    <img class="mb-4" src="../assets/images/logo.png" alt="" width="120" height="120">
    <h1 class="h3 mb-3 font-weight-normal">Регистрация аккаунта</h1>
    <label for="inputEmail" class="sr-only">Username</label>
    <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Регистрация</button>
    <p class="mt-5 mb-3 text-muted">&copy; Sasha Yershov 2018</p>
</form>
</body>
</html>
