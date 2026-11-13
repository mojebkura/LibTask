
<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = $_GET['id'];
$book = getBookById($pdo, $id);

if (!$book) {
    $_SESSION['msg_error'] = 'Книга не найдена';
    header('Location: /books/show_books.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $publish_date = $_POST['publish_date'];
    $all_quantity = $_POST['all_quantity'];
    $free_quantity = $_POST['free_quantity'];
    $author_id = $_POST['author_id'];
    $genre_id  = $_POST['genre_id'];

    if (!$name || !$author_id || !$genre_id) {
        $_SESSION['msg_error'] = 'Заполните название, автора и жанр';
        header("Location: /books/edit_books.php?id=$id");
        exit;
    }

    UpdateBook($pdo, $id, $name, $publish_date, $all_quantity, $free_quantity, $author_id, $genre_id);
    $_SESSION['message_success'] = 'Книга обновлена';
    header('Location: /books/show_books.php');
    exit;
}

$authors = SelectAuthor($pdo);
$genres  = SelectGenre($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать книгу</title>
</head>
<body>
<form method="post">
    <label>Название</label><br>
    <input type="text" name="name" value="<?php echo $book['name'] ?>" required><br><br>

    <label>Дата публикации</label><br>
    <input type="date" name="publish_date" value="<?php echo $book['publish_date'] ?>"><br><br>

    <label>Всего экземпляров</label><br>
    <input type="number" name="all_quantity" value="<?php echo $book['all_quantity'] ?>" min="0"><br><br>

    <label>Свободно экземпляров</label><br>
    <input type="number" name="free_quantity" value="<?php echo $book['free_quantity'] ?>" min="0"><br><br>

    <label>Автор</label><br>
    <select name="author_id" required>
        <option value="">выберите автора</option>
        <?php foreach ($authors as $author): ?>
            <option value="<?php echo $author['id']; ?>"
                <?php echo ($author['id'] == $book['author_id']) ? 'selected' : ''; ?>>
                <?php echo $author['name']; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Жанр</label><br>
    <select name="genre_id" required>
        <option value="">выберите жанр</option>
        <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['id']; ?>"
                <?php echo ($genre['id'] == $book['genre_id']) ? 'selected' : ''; ?>>
                <?php echo $genre['name']; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Сохранить</button>
    <a href="show_book.php">Назад</a>
</form>

<?php
if (!empty($_SESSION['msg_error'])) {
    echo '<p>' . $_SESSION['msg_error'] . '</p>';
    unset($_SESSION['msg_error']);
}
?>
</body>
</html>