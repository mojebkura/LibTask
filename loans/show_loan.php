<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$loans = SelectLoans($pdo);
?>
    <!doctype html>
    <html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Выдачи</title>
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
</body>
    </html><?php
