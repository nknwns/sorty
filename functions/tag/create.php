<?php

session_start();
require '../../config.php';
require '../../functions.php';

if (isset($_POST['add'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $field = (int)$_POST['field'];

    $sql = "SELECT * FROM `#` WHERE `name` = '" . $name . "'";
    $data = mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);
    if (mysqli_num_rows($data)) {
        $_SESSION['notify'] = 'Такой хештег уже существует';
        header('Location: ../../index.php');
        exit;
    }

    $sql = "INSERT INTO `#` (`name`) VALUES ('" . $name . "')";
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);
    $id = mysqli_insert_id($DATABASE);

    $sql = "INSERT INTO `#_field` (`id_#`, `id_field`) VALUES (" . $id . "," . $field .")";
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $_SESSION['notify'] = 'Хештег успешно добавлен';
}

header('Location: ../../index.php');

?>