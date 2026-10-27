
<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    if (!$name) {
        $_SESSION['msg_error'] = 'Введите имя автора';
        header('Location: add_author.php');
        exit;
    }

    if (AddAuthor($pdo, $name)) {
        $_SESSION['message_success'] = 'Автор добавлен';
        header('Location: show_author.php');
        exit;
    } else {
        $_SESSION['msg_error'] = 'Ошибка при добавлении автора';
        header('Location: add_author.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить автора</title>
</head>
<body>
<div class="container mt-3">
    <h1>Добавить автора</h1>

    <?php if (!empty($_SESSION['msg_error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['msg_error']; unset($_SESSION['msg_error']); ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Имя</label><br>
        <input type="text" name="name" required>
        <br><br>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="show_author.php" class="btn btn-secondary">Назад</a>
    </form>
</div>
</body>
</html>