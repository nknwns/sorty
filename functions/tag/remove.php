<?php

session_start();
require '../../config.php';
require '../../functions.php';

if (isset($_GET['id'])) {
    $sql = "DELETE FROM `#` WHERE `id` = " . $_GET['id'];
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $sql = "DELETE FROM `#_field` WHERE `id_#` = " . $_GET['id'];
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $sql = "UPDATE `SMS` SET `#_id` = NULL WHERE `#_id` = " . $_GET['id'];
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $_SESSION['notify'] = 'Хештег успешно удален';
}

header('Location: ../../index.php');

?>