<?php
session_start();

foreach ($_SESSION as $key => $item) unset($_SESSION[$key]);
setcookie('token', "", time() - 3600);
header('Location: ../pages/auth.php');