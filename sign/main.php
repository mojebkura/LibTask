<?php
session_start();

if (empty($_SESSION['User'])) {
    $_SESSION['msg_error'] = 'Сначала войдите в аккаунт';
    header('Location: index.php');
    exit;
}

$login = $_SESSION['User']['login'];
$role  = $_SESSION['User']['role'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Основная страница</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid justify-content-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/loans/show_loan.php">Выдачи</a></li>
                <li class="nav-item"><a class="nav-link" href="/authors/show_author.php">Авторы</a></li>
                <li class="nav-item"><a class="nav-link" href="/genres/show_genre.php">Жанры</a></li>
                <li class="nav-item"><a class="nav-link" href="/books/show_book.php">Книги</a></li>
                <li class="nav-item"><a class="nav-link" href="/users/show_user.php">Пользователи</a></li>
                <li class="nav-item"><a class="nav-link" href="/logic/logic.php">Аналитика</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <h1>Главная страница</h1>
    <p>Пользователь: <b><?php echo $login; ?></b></p>
    <p>Твоя роль: <?php echo $role; ?></p>
    <a href="/logout.php">Выйти</a>
</div>

</body>
</html>