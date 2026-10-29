<?php
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login    = $_POST['login'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = $_POST['role'] ?? 'user';
    $is_blocked = isset($_POST['is_blocked']) ? 1 : 0;
    $created_at = date('Y-m-d');

    if (!$login || !$email || !$password) {
        $_SESSION['msg_error'] = 'Заполните обязательные поля';
        header('Location: add_user.php');
        exit;
    }

    if (getUserLogin($pdo, $login)) {
        $_SESSION['msg_error'] = 'Такой логин уже занят';
        header('Location: add_user.php');
        exit;
    }

    if (emailExists($pdo, $email)) {
        $_SESSION['msg_error'] = 'Такая почта уже используется';
        header('Location: add_user.php');
        exit;
    }

    if (AddUser($pdo, $login, $email, $created_at, $password, $role)) {
        // если сразу заблокирован — выставляем флаг
        if ($is_blocked) {
            $newUser = getUserLogin($pdo, $login);
            UpdateUser($pdo, $newUser['id'], $login, $email, $role, 1);
        }
        $_SESSION['message_success'] = 'Пользователь добавлен';
        header('Location: show_users.php');
        exit;
    } else {
        $_SESSION['msg_error'] = 'Не удалось добавить пользователя';
        header('Location: add_user.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить пользователя</title>
</head>
<body>
<div class="container mt-3">
    <h1>Добавить пользователя</h1>

    <?php if (!empty($_SESSION['msg_error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['msg_error']; unset($_SESSION['msg_error']); ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Логин</label><br>
        <input type="text" name="login" required><br><br>

        <label>Почта</label><br>
        <input type="email" name="email" required><br><br>

        <label>Пароль</label><br>
        <input type="password" name="password" required><br><br>

        <label>Роль</label><br>
        <select name="role">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select><br><br>

        <label>
            <input type="checkbox" name="is_blocked" value="1"> Заблокирован
        </label><br><br>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="show_users.php" class="btn btn-secondary">Назад</a>
    </form>
</div>
</body>
</html>