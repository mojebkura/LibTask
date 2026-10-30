<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$totalloans = TotalLoans($pdo);
$topgenre   = PopularGenre($pdo);
$topbook    = PopularBook($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Аналитика</title>
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
    <div>Всего выдач</div>
    <div class="card-value"><?php echo $totalloans; ?></div>

    <div>Топ жанр</div>
    <div class="card-value">
        <?php echo ($topgenre) ? $topgenre['genre_name'] . ' (' . $topgenre['loan_count'] . ')' : '—'; ?>
    </div>

    <div>Топ книга</div>
    <div class="card-value">
        <?php echo ($topbook) ? $topbook['book_name'] . ' (' . $topbook['loan_count'] . ')' : '—'; ?>
    </div>
</div>
</body>
</html>