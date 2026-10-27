<?php
session_start();
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/function.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <form action="signup.php" method="POST">
    <label>Имя:</label>
    <input type="text" name="name"
    <br><br><br><label>Логин:   </label>
    <input type="text" name="login">
    <br><br><label>Почта:</label>
    <input type="email" name="email"
    <br><br><br><label>Пароль:</label>
    <input type="password" name="password">
    <br><br><label>Подтвердите пароль:</label>
    <input type="password" name="password_confirm">

<?php 
        if($_SESSION['msg_error']){
            echo '<p>'. $_SESSION['msg_error'] . '</p>';
            unset($_SESSION['msg_error']);
        }
?>
<br><a href="index.php">Есть аккаунт?</a>
    <br><br><br><button type="submit">Зарегистрироваться</button>

</body>
</html>