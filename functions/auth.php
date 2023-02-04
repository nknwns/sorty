<?php

session_start();
require '../config.php';
require '../functions.php';

if (isset($_POST['auth'])) {
    $password = trim(htmlspecialchars($_POST['password']));
    $email = trim(htmlspecialchars($_POST['email']));

    $sql = 'SELECT `id`, `password` FROM users WHERE `email` = "' . $email . '";';
    $data = mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $props = mysqli_fetch_assoc($data);

    if ($props) {
        if (md5($password) != $props['password']) {
            $_SESSION['error-type'] = 'password-error';
            header('Location: /pages/auth.php');
            exit;
        }
        else {
            $_SESSION['id'] = $props['id'];

            if ($_POST['save'] == "on") {
                $token = $props['id'] . $props['email'] . $props['password'];
                $token = md5($token);
                $sql = 'UPDATE `users` SET `token` = "' . $token . '";';

                mysqli_query($DATABASE, $sql);
                check_sql_error($DATABASE);
                setcookie('token', $token, time() + 604800);
            } else {
                setcookie('token', '', time() - 3600);
            }

            header('Location: /pages/home.php');
            exit;
        }
    } else {
        $_SESSION['error-state'] = 'user-error';
        header('Location: /pages/auth.php');
        exit;
    }
} else {
    header('Location: /pages/auth.php');
}

?>