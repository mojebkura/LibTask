<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$users = SelectUsers($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пользователи</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid justify-content-center">
        <div class="collapse navbar-collapse" id="navbarNav">
            <li class="nav-item"><a class="nav-link" href="/main.php">Основная страница</a></li>
            <li class="nav-item"><a class="nav-link" href="/authors/show_author.php">Авторы</a></li>
            <li class="nav-item"><a class="nav-link" href="/genres/show_genre.php">Жанры</a></li>
            <li class="nav-item"><a class="nav-link" href="/books/show_books.php">Книги</a></li>
            <li class="nav-item"><a class="nav-link" href="/logic/logic.php">Аналитика</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <h1>Пользователи</h1>
    <table class="table">
        <thead>
        <tr>

            <th>логин</th>
            <th>почта</th>
            <th>роль</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>

                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>