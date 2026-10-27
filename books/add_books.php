<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name         = $_POST['name'];
    $publish_date = $_POST['publish_date'];
    $all_quantity = $_POST['all_quantity'];
    $free_quantity = $all_quantity;
    $author_id    = $_POST['author_id'];
    $genre_id     = $_POST['genre_id'];

    if (!$name || !$author_id || !$genre_id) {
        $_SESSION['msg_error'] = 'Заполните все обязательные поля';
        header('Location: add_book.php');
        exit;
    }

    if (AddBook($pdo, $name, $publish_date, $all_quantity, $free_quantity, $author_id, $genre_id)) {
        $_SESSION['message_success'] = 'Книга добавлена';
        header('Location: show_book.php');
        exit;
    } else {
        $_SESSION['msg_error'] = 'Не удалось добавить книгу';
        header('Location: add_book.php');
        exit;
    }
}
$authors = SelectAuthor($pdo);
$genres  = SelectGenre($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить книгу</title>
</head>
<body>
<?php if (!empty($_SESSION['msg_error'])): ?>
    <p><?php echo $_SESSION['msg_error']; ?></p>
    <?php unset($_SESSION['msg_error']); ?>
<?php endif; ?>

<form method="post">
    <label>Название</label><br>
    <input type="text" name="name" required><br><br>

    <label>Дата публикации</label><br>
    <input type="date" name="publish_date"><br><br>

    <label>Количество</label><br>
    <input type="number" name="all_quantity" value="1" min="0"><br><br>

    <label>Автор</label><br>
    <select name="author_id" required>
        <option value="">выберите автора</option>
        <?php foreach ($authors as $author): ?>
            <option value="<?php echo $author['id']; ?>"><?php echo $author['name']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Жанр</label><br>
    <select name="genre_id" required>
        <option value="">выберите жанр</option>
        <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['id']; ?>"><?php echo $genre['name']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Сохранить</button>
    <a href="show_book.php">Назад</a>
</form>
</body>
</html>