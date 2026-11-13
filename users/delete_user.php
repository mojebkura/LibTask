<?php
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = $_GET['id'];
$user = getUserById($pdo, $id);

if (!$user) {
    $_SESSION['msg_error'] = 'Пользователь не найден';
    header('Location: show_users.php');
    exit;
}

if ($user['id'] == $_SESSION['User']['id']) {
    $_SESSION['msg_error'] = 'Нельзя удалить свой аккаунт';
    header('Location: show_users.php');
    exit;
}

if (DeleteUser($pdo, $id)) {
    $_SESSION['message_success'] = 'Пользователь удалён';
} else {
    $_SESSION['msg_error'] = 'Не удалось удалить пользователя';
}

header('Location: show_users.php');
exit;
