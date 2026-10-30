<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = ($_GET['id']);
$genre = getGenreById($pdo, $id);

if (!$genre) {
    $_SESSION['msg_error'] = 'Жанр не найден';
    header('Location: show_genre.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    if (!$name) {
        $_SESSION['msg_error'] = 'Введите название';
        header("Location: edit_genre.php?id=$id");
        exit;
    }

    UpdateGenre($pdo, $id, $name);
    $_SESSION['message_success'] = 'Жанр обновлён';
    header('Location: show_genre.php');
    exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Изменить жанр</title>
</head>
<body>
<form method="post">
    <label>Название</label><br>
    <input type="text" name="name"
           value="<?php echo $genre['name'] ?>" required>
    <br><br>
    <button type="submit">Сохранить</button>
    <a href="show_genre.php">Назад</a>
</form>
</body>
</html>