<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$authors = SelectAuthor($pdo);
?>
    <!doctype html>
    <html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторы</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid justify-content-center">
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
    <h1>Авторы</h1>
    <a href="add_author.php" class="btn btn-success mb-3">Добавить автора</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">имя</th>
            <th>действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($authors as $author): ?>
            <tr>
                <td><?php echo $author['id'] ?></td>
                <td><?php echo $author['name'] ?></td>
                <td>
                    <a href="delete_author.php?id=<?php echo $author['id'] ?>">Удалить</a>
                    <a href="edit_author.php?id=<?php echo $author['id'] ?>">Изменить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
    </html><?php
