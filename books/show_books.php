<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$books = SelectBooks($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Книги</title>
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
    <h1>Книги</h1>
    <a href="/books/add_books.php" class="btn btn-success mb-3">Добавить книгу</a>

    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>название</th>
            <th>дата публикации</th>
            <th>всего</th>
            <th>свободно</th>
            <th>автор</th>
            <th>жанр</th>
            <th>действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <?php $author = getAuthorById($pdo, $book['author_id']); ?>
            <?php $genre  = getGenreById($pdo, $book['genre_id']); ?>
            <tr>
                <td><?php echo $book['id']; ?></td>
                <td><?php echo $book['name']; ?></td>
                <td><?php echo $book['publish_date']; ?></td>
                <td><?php echo $book['all_quantity']; ?></td>
                <td><?php echo $book['free_quantity']; ?></td>
                <td><?php echo $author['name']; ?></td>
                <td><?php echo $genre['name']; ?></td>
                <td>
                    <a href="/books/delete_books.php?id=<?php echo $book['id']; ?>">Удалить</a>
                    <a href="/books/edit_books.php?id=<?php echo $book['id']; ?>">Изменить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>