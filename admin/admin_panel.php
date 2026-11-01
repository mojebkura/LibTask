<?php
session_start();
require __DIR__ . '/admin_check.php';
require './src/db.php';
require './src/function.php';

$authors = SelectAuthor($pdo);
$loans = SelectLoans($pdo);
$books = SelectBooks($pdo);
$genres = SelectGenre($pdo);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ Панель</title>
</head>
<body>
<!--___________________Книги________-->
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
<!--_____________Жанры______________-->
<h1>Жанры</h1>
<div class="container mt-3">
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
<!--__________Выдачи___________-->
<h1>Выдачи</h1>
<a href="add_loan.php" class="btn btn-success mb-3">Добавить выдачу</a>
<?php if (!empty($_SESSION['message_success'])): ?>
    <p><?php echo $_SESSION['message_success'] ?></p>
    <?php unset($_SESSION['message_success']); ?>
<?php endif; ?>

<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>книга</th>
        <th>пользователь</th>
        <th>дата выдачи</th>
        <th>дата возврата (план)</th>
        <th>дата возврата (факт)</th>
        <th>статус</th>
        <th>действие</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($loans as $loan): ?>
        <tr>
            <td><?php echo $loan['id']; ?></td>
            <td><?php echo $loan['book_name']; ?></td>
            <td><?php echo $loan['user_login']; ?></td>
            <td><?php echo $loan['give_date']; ?></td>
            <td><?php echo $loan['due_date']; ?></td>
            <td><?php echo $loan['return_date']; ?></td>
            <td><?php echo $loan['status']; ?></td>
            <td>
                <a href="delete_loan.php?id=<?php echo $loan['id']; ?>">Удалить</a>
                <a href="edit_loan.php?id=<?php echo $loan['id']; ?>">Изменить</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<!--__________Авторы______________-->
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
<!--___________Пользователи______________-->
<div class="container mt-3">
    <h1>Пользователи</h1>
    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>логин</th>
            <th>почта</th>
            <th>роль</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
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
