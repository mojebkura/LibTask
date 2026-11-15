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
<title>Аналитика</title>

<div class="container mt-3"></div>
    <div class="card-value"><?php echo $totalloans; ?></div>

    <div>Топ жанр</div>
    <div class="card-value">
        <?php echo $topgenre['genre_name'] ?>
    </div>

    <div>Топ книга</div>
    <div class="card-value">
        <?php echo $topbook['book_name']?>
    </div>
</div>
</body>
</html>