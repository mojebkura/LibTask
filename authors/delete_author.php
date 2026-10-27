<?php
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';
$id = $_GET['id'];
$result = DeleteAuthor($pdo, $id);
if ($result) {
    header('Location: show_author.php');
    exit;
}

