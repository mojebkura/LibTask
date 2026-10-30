<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = ($_GET['id']);
$author = getAuthorById($pdo, $id);

if (!$author) {
    $_SESSION['msg_error'] = 'Автор не найден';
    header('Location: show_author.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    if (!$name) {
        $_SESSION['msg_error'] = 'Введите имя';
        header("Location: edit_author.php?id=$id");
        exit;
    }

    UpdateAuthor($pdo, $id, $name);
    $_SESSION['message_success'] = 'Автор обновлён';
    header('Location: show_author.php');
    exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Изменить автора</title>
</head>
<body>
<form method="post">
    <label>Имя</label><br>
    <input type="text" name="name"
           value="<?php echo $author['name'] ?>" required>
    <br><br>
    <button type="submit">Сохранить</button>
    <a href="show_author.php">Назад</a>
</form>
</body>
</html>
