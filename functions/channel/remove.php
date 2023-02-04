<?php

session_start();
require '../../config.php';
require '../../functions.php';

if (isset($_GET['id'])) {
    $sql = "DELETE FROM `channels` WHERE `id` = " . $_GET['id'];
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $sql = "DELETE FROM `SMS` WHERE `channel_id` = " . $_GET['id'];
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    unset($_SESSION['view'], $_SESSION['channel-id']);
    $_SESSION['notify'] = 'Канал успешно удален';
}

header('Location: ../../index.php');

?>