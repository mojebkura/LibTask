<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = $_GET['id'];
$result = DeleteRequest($pdo, $id);
if ($result){
    header('Location: /books/show_requests.php');
    exit;
}
?>