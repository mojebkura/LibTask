<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$genres = SelectGenre($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Жанры</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid justify-content-center">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/loans/show_loan.php">Выдачи</a></li>
                <li class="nav-item"><a class="nav-link" href="/authors/show_author.php">Авторы</a></li>
                <li class="nav-item"><a class="nav-link" href="/genres/show_genre.php">Жанры</a></li>
                <li class="nav-item"><a class="nav-link" href="/books/show_books.php">Книги</a></li>
                <li class="nav-item"><a class="nav-link" href="/users/show_users.php">Пользователи</a></li>
                <li class="nav-item"><a class="nav-link" href="/logic/logic.php">Аналитика</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <h1>Жанры</h1>
    <a href="add_genre.php" class="btn btn-success mb-3">Добавить жанр</a>

    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>название</th>
            <th>действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($genres as $genre): ?>
            <tr>
                <td><?php echo $genre['id'] ?></td>
                <td><?php echo $genre['name'] ?></td>
                <td>
                    <a href="delete_genre.php?id=<?php echo $genre['id'] ?>">Удалить</a>
                    <a href="edit_genre.php?id=<?php echo $genre['id'] ?>">Изменить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>