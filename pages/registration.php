<?php
session_start();
if (isset($_SESSION['id'])) {
    header('Location: /index.php');
} elseif (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $sql = 'SELECT `id` FROM users WHERE `token` = "' . $token . '";';
    $data = mysqli_query($DATABASE, $sql);
    $user = mysqli_fetch_assoc($data);

    if ($user) {
        $_SESSION['id'] = $user['id'];
        setcookie('token', $token, time() + 604800);
        header('Location: home.php');
    } else {
        setcookie('token', "", time() - 3600);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
</head>
<body>
<main>
    <section class="home">
        <div class="container">
            <div class="columns">
                <div class="column col-6 col-md-12 col-mx-auto">
                    <div class="panel">
                        <div class="panel-header text-center">
                            <div class="panel-title h5 mt-10">Sorty</div>
                            <div class="panel-subtitle">Мессенджер</div>
                        </div>
                        <nav class="panel-nav">
                            <ul class="tab tab-block">
                                <li class="tab-item"><a href="auth.php">Авторизация</a></li>
                                <li class="tab-item active"><a href="registration.php">Регистрация</a></li>
                            </ul>
                        </nav>
                        <div class="panel-body">
                            <form action="/functions/registration.php" method="post" class="form">
                                <div class="form-group">
                                    <label class="form-label" for="input-email">Email</label>
                                    <input class="form-input" type="email" name="email" id="input-email" required placeholder="ivan@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="input-name">Имя пользователя</label>
                                    <input class="form-input" type="text" name="name" id="input-name" required pattern="^[a-zA-Zа-яА-ЯёЁ]+\s[a-zA-Zа-яА-ЯёЁ]+$" placeholder="Иван Иванов">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="input-password">Пароль</label>
                                    <input class="form-input" type="password" name="password" id="input-password" required placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button name="registration" class="btn">Зарегистрироваться</button>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>