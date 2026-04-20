<?php
$host = 'localhost';
$dbname = 'notes_app';
$username = 'root';
$password = 'root';  // В MAMP пароль 'root'

try {
    $pdo = new PDO("mysql:host=$host;port=8889;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

session_start();
?>