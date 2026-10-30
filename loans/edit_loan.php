
<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = $_GET['id'];
$loan = getLoanById($pdo, $id);

if (!$loan) {
    $_SESSION['msg_error'] = 'Выдача не найдена';
    header('Location: show_loan.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $books_id  = $_POST['books_id'];
    $users_id  = $_POST['users_id'];
    $give_date = $_POST['give_date'];
    $due_date = $_POST['due_date'];
    $return_date = $_POST['return_date'] ?: null;
    $status = $_POST['status'];

    UpdateLoan($pdo, $id, $books_id, $users_id, $give_date, $due_date, $return_date, $status);
    if (!empty($loan['return_date']) && empty($return_date)) {
        $book = getBookById($pdo, $books_id);
        if ($book && $book['free_quantity'] > 0) {
            UpdateBook($pdo, $books_id, 
                    $book['name'],
                    $book['publish_date'],
                    $book['all_quantity'],
                    $book['free_quantity'] - 1,
                    $book['author_id'],
                    $book['genre_id']);
        }
    }

    if (empty($loan['return_date']) && !empty($return_date)) {
        $book = getBookById($pdo, $books_id);
        if ($book) {
            UpdateBook($pdo, $books_id,
                $book['name'],
                $book['publish_date'],
                $book['all_quantity'],
    $book['free_quantity'] + 1,
                $book['author_id'],
                $book['genre_id']);
        }
    }

    $_SESSION['message_success'] = 'Выдача обновлена';
    header('Location: show_loan.php');
    exit;
}

$users = SelectUsers($pdo);
$books = SelectBooks($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать выдачу</title>
</head>
<body>
<form method="post">
    <label>Книга</label><br>
    <select name="books_id" required>
        <?php foreach ($books as $book): ?>
            <option value="<?php echo $book['id']; ?>"
                <?php echo ($book['id'] == $loan['books_id']) ? 'selected' : ''; ?>>
                <?php echo $book['name']; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Пользователь</label><br>
    <select name="users_id" required>
        <?php foreach ($users as $user): ?>
            <option value="<?php echo $user['id']; ?>"
                <?php echo ($user['id'] == $loan['users_id']) ? 'selected' : ''; ?>>
                <?php echo $user['login']; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Дата выдачи</label><br>
    <input type="date" name="give_date" value="<?php echo $loan['give_date']; ?>" required><br><br>

    <label>Дата возврата (план)</label><br>
    <input type="date" name="due_date" value="<?php echo $loan['due_date']; ?>" required><br><br>

    <label>Дата возврата (факт)</label><br>
    <input type="date" name="return_date" value="<?php echo $loan['return_date']; ?>"><br><br>

    <label>Статус</label><br>
    <select name="status">
        <?php
        $statuses = ['Выдана', 'Возвращена', 'Просрочено', 'Просрочено/Возвращено'];
        foreach ($statuses as $status):
        ?>
            <option value="<?php echo $status; ?>"
                    <?php echo ($status === $loan['status']) ? 'selected' : ''; ?>>
                <?php echo $status; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Сохранить</button>
    <a href="show_loan.php">Назад</a>
</form>
</body>
</html>