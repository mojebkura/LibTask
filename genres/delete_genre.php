<?php
session_start();
require __DIR__ . '/../admin_check.php';
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/function.php';

$genreId = (int)($_GET['id'] ?? 0);

if ($genreId > 0) {

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM books WHERE genre_id = ?");
    $stmt->execute([$genreId]);
    $bookCount = (int)$stmt->fetchColumn();

    if ($bookCount > 0) {
        $_SESSION['message_error'] =
            "Нельзя удалить жанр: с ним связано книг — {$bookCount}.";
    } else {
        try {
            DeleteGenre($pdo, $genreId);
            $_SESSION['message_success'] = "Жанр успешно удалён.";
        } catch (PDOException $e) {
            $_SESSION['message_error'] =
                "Ошибка при удалении жанра: " . $e->getMessage();
        }
    }
} else {
    $_SESSION['message_error'] = "Некорректный id жанра.";
}

header('Location: /admin.php');
exit;