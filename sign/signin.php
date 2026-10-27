<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$login = $_POST['login'];
$password = $_POST['password'];

$user = getUserLogin($pdo, $login);

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['msg_error'] = 'Неверный логин или пароль';
    header('Location: ../index.php');
    exit;
}

$_SESSION['User'] = [
    'id'    => $user['id'],
    'login' => $user['login'],
    'role'  => $user['role'],
];

header('Location: ../main.php');
exit;