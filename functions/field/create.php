<?php

session_start();
require '../../config.php';
require '../../functions.php';

if (isset($_POST['create'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $description = trim(htmlspecialchars($_POST['description']));

    $sql = "SELECT * FROM `field` WHERE `name` = '" . $name . "'";
    $data = mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);
    if (mysqli_num_rows($data)) {
        $_SESSION['notify'] = 'Такая область знаний уже существует';
        header('Location: ../../index.php');
        exit;
    }


    $sql = "INSERT INTO `field` (`name`, `description`) VALUES ('" . $name . "', '" . $description ."')";
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $_SESSION['notify'] = 'Область знаний успешно созданаа';
}

header('Location: ../../index.php');

?>