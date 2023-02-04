<?php

session_start();

if (isset($_SESSION['id'])) {
    if (isset($_GET['t'])) $_SESSION['tab'] = $_GET['t'];
    if (isset($_GET['v'])) {
        $_SESSION['view'] = $_GET['v'];
        if (isset($_GET['id'])) {
            if ($_GET['v'] == 'messages') {
                $_SESSION['channel-id'] = $_GET['id'];
                unset($_SESSION['field-id']);
            }
            elseif ($_GET['v'] == 'tags') {
                $_SESSION['field-id'] = $_GET['id'];
                unset($_SESSION['channel-id']);
            }
        }
    }
    if (isset($_GET['m'])) $_SESSION['modal'] = $_GET['m'];
    if (isset($_GET['filter'])) $_SESSION['filter'] = $_GET['filter'];

    header('Location: pages/home.php');
}
else header('Location: pages/auth.php', true);