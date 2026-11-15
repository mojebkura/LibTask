<?php
session_start();
require_once __DIR__ . '/../src/function.php';
require_once __DIR__ . '/../src/db.php';

$id = $_GET['id'];
$result = DeleteBook($pdo, $id);
if ($result){
    header('Location: /admin_panel.php');
    exit;
}
?>