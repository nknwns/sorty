<?php
    session_start();
    require '../config.php';
    require '../functions.php';

    if (!isset($_SESSION['id'])) {
        header('Location: auth.php');
        exit;
    }

    $USER = get_user($DATABASE, $_SESSION['id']);

    if (!isset($_SESSION['tab'])) $_SESSION['tab'] = 'channels';
    if (!isset($_SESSION['view'])) $_SESSION['view'] = 'empty';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список каналов</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main>
    <section class="home">
        <div class="container">
            <div class="columns">
                <?php require '../components/tabs/tabs.php'?>
                <?php require '../components/views/views.php' ?>
            </div>
        </div>
    </section>
    <?php
        if (isset($_SESSION['notify'])) {
            require '../components/alerts/notify.php';
        }
        if (isset($_SESSION['warning'])) {
            require '../components/alerts/warning.php';
        }

        if (isset($_SESSION['modal'])) {
            require '../components/modals/' . $_SESSION['modal'] . '.php';
            unset($_SESSION['modal']);
        }
    ?>
</main>
<script src="../js/main.js"></script>
</body>
</html>