<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$requests = SelectRequests($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Запросы</title>
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
    <h1>Запросы</h1>

    <table class="table">
        <thead>
        <tr>
            <th>аккаунт (ID)</th>
            <th>книга</th>
            <th>действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?php echo $request['user_name']; ?></td>
                <td><?php echo $request['book_name']; ?></td>
                <td>
                    <a href="/request/delete_request.php?id=<?php echo $request['id']; ?>">Удалить</a>
                    <a href="/request/edit_request.php?id=<?php echo $request['id']; ?>">Изменить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>