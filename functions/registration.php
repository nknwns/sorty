<?php

session_start();
require '../config.php';
require '../functions.php';

if (isset($_POST['registration'])) {
    $password = md5(trim(htmlspecialchars($_POST['password'])));
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));

    $sql = "SELECT * FROM `users` WHERE `email` = '" . $email . "'";
    $data = mysqli_query($DATABASE, $sql);

    check_sql_error($DATABASE);
    if (mysqli_num_rows($data)) {
        $_SESSION['error-state'] = 'user-registration-error';
        header('Location: ../pages/registration.php');
        exit;
    }

    $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('" . $name . "', '" . $email . "', '" . $password . "')";
    
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);
    $id = mysqli_insert_id($DATABASE);

    $_SESSION['id'] = $id;
    header('Location: ../pages/home.php');
} else {
    header('Location: ../pages/registration.php');
}

?>