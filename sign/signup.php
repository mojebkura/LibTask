<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$login  = $_POST['login'];
$email  = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$role  = 'user';
$created_at = date('Y-m-d');

if (!$login|| !$email || !$password) {
    $_SESSION['msg_error'] = 'Заполните все обязательные поля';
    header('Location: ./sign/registration.php');
    exit;
}

if ($password !== $password_confirm) {
    $_SESSION['msg_error'] = 'Пароли не совпадают';
    header('Location: ./sign/registration.php');
    exit;
}

if (getUserLogin($pdo, $login)) {
    $_SESSION['msg_error'] = "Пользователь с логином '{$login}' уже существует.";
    header('Location: ./sign/registration.php');
    exit;
}

if (emailExists($pdo, $email)) {
    $_SESSION['msg_error'] = 'Пользователь с такой почтой уже существует';
    header('Location: ./sign/registration.php');
    exit;
}

if (AddUser($pdo, $login, $email, $created_at, $password, $role)) {
    $_SESSION['message_success'] = 'Регистрация успешна! Войдите в аккаунт.';
    header('Location: /../index.php');
    exit;
} else {
    $_SESSION['msg_error'] = 'Не удалось зарегистрировать пользователя.';
    header('Location: ./sign/registration.php');
    exit;
}