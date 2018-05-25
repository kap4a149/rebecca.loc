<?php
require_once '../core/Db.php';
include_once '../core/session.php';
$login = mb_strtolower(trim($_POST['username']));
$password = trim($_POST['password']);

if(!empty($login) && !empty($password)){
    $sql = "SELECT login,password FROM users where login = :login";
    $params = [':login' => $login];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_OBJ);
//    echo $user->login;
//    echo $user->password;
    if($user) {
        if (password_verify($password, $user->password)) {
            $_SESSION['auth'] = $user->login;
//            setcookie('login', $user->login, time()+ 10000 * 10000, '/');
            header('Location: ../index.php');
        }
    }
    else{
        echo 'Неверный логин или пароль';
    }

}
?>