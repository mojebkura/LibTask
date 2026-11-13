<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = $_GET['id'];
$loan = getLoanById($pdo, $id);

if ($loan && DeleteLoan($pdo, $id)) {
    if (empty($loan['return_date'])) {
        $book = getBookById($pdo, $loan['books_id']);
        if ($book) {
            UpdateBook($pdo, $loan['books_id'],
                $book['name'],
                $book['publish_date'],
                $book['all_quantity'],
                $book['free_quantity'] + 1,
                $book['author_id'],
                $book['genre_id']);
        }
    }
    $_SESSION['message_success'] = 'Выдача удалена';
} else {
    $_SESSION['msg_error'] = 'Не удалось удалить выдачу';
}

header('Location: show_loan.php');
exit;

