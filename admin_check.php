<?php
session_start();

if (!isset($_SESSION['User']['id'])) {
    $_SESSION['msg_error'] = 'Сначала войдите';
    header('Location: index.php');
    exit;
}

if ($_SESSION['User']['role'] !== 'admin') {
    $_SESSION['msg_error'] = 'Доступ запрещён';
    header('Location: main.php');
    exit;
}
?>