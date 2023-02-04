<?php

session_start();
require '../../config.php';
require '../../functions.php';

if (isset($_POST['create'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $description = trim(htmlspecialchars($_POST['description']));
    $liked = $_POST['liked'] == 'on' ? 1 : 0;

    $sql = "SELECT * FROM `channels` WHERE `name` = '" . $name . "'";
    $data = mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);
    if (mysqli_num_rows($data)) {
        $_SESSION['notify'] = 'Канал с таким названием уже существует';
        header('Location: ../../index.php?m=createChannel');
        exit;
    }

    $sql = "INSERT INTO `channels` (`name`, `description`, `liked`) VALUES ('" . $name . "', '" . $description . "', " . $liked . ")";
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);
    $_SESSION['notify'] = 'Канал успешно создан';

}

header('Location: ../../index.php');

?>