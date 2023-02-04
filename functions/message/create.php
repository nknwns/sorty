<?php

session_start();
require '../../config.php';
require '../../functions.php';

if (isset($_POST['send'])) {
    $description = trim(htmlspecialchars($_POST['description']));
    $channel = $_POST['channel'];
    $user = $_POST['user'];
    $save = $_POST['save'] == "on" ? 1 : 0;

    if (substr_count($description, "#") > 1) {
        $_SESSION['warning'] = 'Сообщение должно содержать не более одного хештега';
        header('Location: ../../index.php');
        exit;
    }

    preg_match("~\s(#[\w]+)[\s\,\.]~u", " " . $description . " ", $result);
    $tag_ = $result[1];

    $sql = "SELECT `id` FROM `#` WHERE `name` = '" . $tag_ . "'";
    $data = mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $tag = null;
    if ($data !== false && mysqli_num_rows($data)) {
        $tag = mysqli_fetch_row($data)[0];
        $sql = "INSERT INTO `SMS` (`#_id`, `user_id`, `channel_id`, `description`, `save`) VALUES (" . join(',', array($tag, $user, $channel)) . ", '" . $description . "', " . $save . ")";
    } else {
        $sql = "INSERT INTO `SMS` (`user_id`, `channel_id`, `description`, `save`) VALUES (" . join(',', array($user, $channel)) . ", '" . $description . "', " . $save . ")";
    }

    $data = mysqli_query($DATABASE, $sql);
    check_sql_error($DATABASE);

    $_SESSION['notify'] = 'Сообщение успешно отправлено';
}

header('Location: ../../index.php');

?>