<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    if (!$name) {
        $_SESSION['msg_error'] = 'Введите название жанра';
        header('Location: add_genre.php');
        exit;
    }

    if (AddGenre($pdo, $name)) {
        $_SESSION['message_success'] = 'Жанр добавлен';
        header('Location: show_genre.php');
        exit;
    } else {
        $_SESSION['msg_error'] = 'Ошибка при добавлении жанра';
        header('Location: add_genre.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить жанр</title>
</head>
<body>
<div class="container mt-3">
    <h1>Добавить жанр</h1>

    <?php if (!empty($_SESSION['msg_error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['msg_error']; unset($_SESSION['msg_error']); ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Название</label><br>
        <input type="text" name="name" required>
        <br><br>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="show_genre.php" class="btn btn-secondary">Назад</a>
    </form>
</div>
</body>
</html>