<?php
require_once '../core/Db.php';
include_once '../core/session.php';



    if (isset($_POST['g-recaptcha-response'])) {
        $url_to_google_api = "https://www.google.com/recaptcha/api/siteverify";
        $secret_key = '6Lc451YUAAAAAJqq3xPT66oN5qIjW3r4jbaHppgZ';
        $query = $url_to_google_api . '?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR'];
        $data = json_decode(file_get_contents($query));
        if ($data->success) {
            // Продолжаем работать с данными для авторизации из POST массива
            $login = mb_strtolower(trim($_POST['username']));
            $password = trim($_POST['password']);
            $ip = $_SERVER['REMOTE_ADDR'];

            //авторизация
            if (!empty($login) && !empty($password)) {
                $sql = "SELECT login,password FROM users where login = :login; UPDATE users SET ip=:ip where login=:login;";
                $params = [':login' => $login, ':ip' => $ip];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);

                $user = $stmt->fetch(PDO::FETCH_OBJ);
                if ($user) {
                    if (password_verify($password, $user->password)) {
                        $_SESSION['auth'] = $user->login;
                        header('Location: ../index.php');
                    } else {
                        echo 'Неверный логин или пароль';
                    }
                } else {
                    echo 'Неверный логин или пароль';
                }

            }
        } else {
            exit('Извините но похоже вы робот \(0_0)/');
        }
    } else {
        exit('Вы не прошли валидацию reCaptcha');
    }

?>
