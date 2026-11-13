<?php
session_start();
if (!isset($_SESSION['User'])) {
    header('Location: ./index.php');
    exit;
}
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
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/loans/show_loan.php">Выдачи</a></li>
                <li class="nav-item"><a class="nav-link" href="/authors/show_author.php">Авторы</a></li>
                <li class="nav-item"><a class="nav-link" href="/genres/show_genre.php">Жанры</a></li>
                <li class="nav-item"><a class="nav-link" href="/books/show_books.php">Книги</a></li>
                <li class="nav-item"><a class="nav-link" href="/users/show_users.php">Пользователи</a></li>
                <li class="nav-item"><a class="nav-link" href="/logic/logic.php">Аналитика</a></li>
                <?php if ($_SESSION['User']['role'] === 'admin'): ?>
                <a href="/admin_panel.php" class="btn btn-warning">Перейти в админ-панель</a>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <h2>Главная страница</h2>
    <p>Пользоватль: <b><?php echo ($_SESSION['User']['login']) ?></b></p>
    <p>Твоя роль: <?php echo ($_SESSION['User']['role']) ?></p>
    <?php if ($_SESSION['User']['role'] === 'admin'): ?>
        <a href="/admin_panel.php" class="btn btn-warning">Перейти в админ-панель</a>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-danger">Выйти</a>
</div>

</body>