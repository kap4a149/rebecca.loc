<?php
require_once 'db.php';

$login = trim($_POST['username']);
$password = trim($_POST['password']);

if(!empty($login) && !empty($password)) {

    $sql_check = "SELECT EXISTS(SELECT login FROM USERS WHERE login = :login)";
    $options_check = [':login' => $login];
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute($options_check);

    if ($stmt_check->fetchColumn()) {
        die('Пользователь с таким именем уже существует');
    }

    //hashing password
    $password = password_hash($password,PASSWORD_DEFAULT);

    $sql = 'INSERT INTO users(login, password) VALUES(:login, :password)';
    $params = [':login' => $login, ':password' => $password];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    echo 'Вы успешно зарегистрировались';
}
else{
echo 'Заполните все поля!';
}
?>