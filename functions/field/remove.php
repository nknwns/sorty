<?php

session_start();
require '../../config.php';
require '../../functions.php';

if (isset($_GET['id'])) {
    $sql = "DELETE FROM `field` WHERE `id` = " . $_GET['id'];
    mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $sql = "SELECT * FROM `#_field` WHERE `id_field` = " . $_GET['id'];
    $data = mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $tags = array();
    while ($field_to_tag = mysqli_fetch_assoc($data)) array_push($tags, $field_to_tag['id_#']);

    if (count($tags)) {
        $sql = "DELETE FROM `#` WHERE `id` IN (" . join(',', $tags) . ")";
        mysqli_query($DATABASE, $sql);
        check_sql_error($DATABASE);

        $sql = "DELETE FROM `#_field` WHERE `id_field` = " . $_GET['id'];
        mysqli_query($DATABASE, $sql);
        check_sql_error($DATABASE);

        $sql = "UPDATE `SMS` SET `#_id` = NULL WHERE `#_id` = " . $_GET['id'];
        mysqli_query($DATABASE, $sql);
        check_sql_error($DATABASE);
    }

    unset($_SESSION['view'], $_SESSION['field-id']);
    $_SESSION['notify'] = 'Область успешно удалена';
}

header('Location: ../../index.php');

?>