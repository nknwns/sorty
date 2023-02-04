<?php

session_start();

unset($_SESSION['filter']);

header('Location: ../../index.php');

?>