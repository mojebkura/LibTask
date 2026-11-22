<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = $_GET['id'];
$book = getBookById($pdo, $id);
if ($book) {
    $result = AddRequest($pdo, $_SESSION['user_id'], $book['name']);
    if ($result) {
        header('Location: /books/show_books.php');
        exit;
    }
}
header('Location: /books/show_books.php');
exit;
?>