<?php
require_once 'Db.php';
include_once 'session.php';

if(isset($_SESSION['auth'])){
    die('Вы уже авторизованы!');
}

    if (isset($_POST['g-recaptcha-response'])) {
        $url_to_google_api = "https://www.google.com/recaptcha/api/siteverify";
        $secret_key = '6Lc451YUAAAAAJqq3xPT66oN5qIjW3r4jbaHppgZ';
        $query = $url_to_google_api . '?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR'];
        $data = json_decode(file_get_contents($query));
        if ($data->success) {
            // Продолжаем работать с данными для авторизации из POST массива
            $login = trim($_POST['username']);
            $password = trim($_POST['password']);

            //процесс регистрации
            if (!empty($login) && !empty($password)) {

                $sql_check = "SELECT EXISTS(SELECT login FROM users WHERE login = :login)";
                $options_check = [':login' => $login];
                $stmt_check = $pdo->prepare($sql_check);
                $stmt_check->execute($options_check);

                if ($stmt_check->fetchColumn()) {
                    die('Пользователь с таким именем уже существует');
                }

                //hashing password
                $password = password_hash($password, PASSWORD_DEFAULT);

                $sql = 'INSERT INTO users(login, password) VALUES(:login, :password)';
                $params = [':login' => $login, ':password' => $password];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                echo 'Вы успешно зарегистрировались, теперь <a href=../pages/signin.php>Авторизуйтесь</a>';
            } else {
                echo 'Заполните все поля!';
            }
        } else {
            exit('Извините но похоже вы робот \(0_0)/');
        }
    } else {
        exit('Вы не прошли валидацию reCaptcha');
    }

?>
