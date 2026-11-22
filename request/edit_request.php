<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = $_GET['id'];
$request = getRequestById($pdo, $id);

if (!$request) {
    $_SESSION['msg_error'] = 'Запрос не найден';
    header('Location: /books/show_requests.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $book_name = $_POST['book_name'];

    if (!$user_name || !$book_name) {
        $_SESSION['msg_error'] = 'Заполните все обязательные поля';
        header("Location: /books/edit_request.php?id=$id");
        exit;
    }

    UpdateRequest($pdo, $id, $user_name, $book_name);
    $_SESSION['message_success'] = 'Запрос обновлён';
    header('Location: /books/show_requests.php');
    exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать запрос</title>
</head>
<body>
<form method="post">
    <label>Аккаунт (ID)</label><br>
    <input type="number" name="user_name" value="<?php echo $request['user_name'] ?>" required><br><br>

    <label>Книга</label><br>
    <input type="text" name="book_name" value="<?php echo $request['book_name'] ?>" required><br><br>

    <button type="submit">Сохранить</button>
    <a href="show_requests.php">Назад</a>
</form>

<?php
if (!empty($_SESSION['msg_error'])) {
    echo '<p>' . $_SESSION['msg_error'] . '</p>';
    unset($_SESSION['msg_error']);
}
?>
</body>
</html>
