<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
requireLogin();

$noteId = $_GET['id'] ?? 0;
deleteNote($pdo, $noteId, $_SESSION['user_id']);
header('Location: index.php');
exit();
?>