<?php

session_start();
require '../../config.php';
require '../../functions.php';

if (isset($_GET['id'])) {
    toggle_channel($DATABASE, $_GET['id'], $_GET['s']);
}

header('Location: ../../index.php');

?>