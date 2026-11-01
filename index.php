<?php
session_start();
require_once __DIR__ . '/src/db.php';
require_once __DIR__ . '/src/function.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>

<form action="sign/signin.php" method="POST">
    <label for="login">Логин:</label>

    <input type="text" id="login" name="login" required>
    <br><br>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>
    <br><br>

    <button type="submit">Войти</button>
    <br><br>
    <span>Нет аккаунта?</span>
    <a href="sign/registration.php">Регистрация</a>
</form>

<?php
if (!empty($_SESSION['msg_error'])) {
    echo '<p>' . htmlspecialchars($_SESSION['msg_error']) . '</p>';
    unset($_SESSION['msg_error']);
}
if (!empty($_SESSION['message_success'])) {
    echo '<p>' . htmlspecialchars($_SESSION['message_success']) . '</p>';
    unset($_SESSION['message_success']);
}
?>
</body>
</html>