<?php
require 'Csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Обязательная проверка CSRF-токена
    if (!Csrf::check($_POST['csrf_token'] ?? '')) {
        http_response_code(403);
        die('❌ Ошибка CSRF: неверный или отсутствующий токен');
    }

    // Если токен верен — выполняем действие
    $title = htmlspecialchars($_POST['title']);
    echo "✅ Объявление создано: " . $title;
}