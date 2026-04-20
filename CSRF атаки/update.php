<?php
require 'Csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Csrf::check($_POST['csrf_token'] ?? '')) {
        http_response_code(403);
        die('Ошибка CSRF: неверный токен');
    }

    $email = htmlspecialchars($_POST['email']);
    echo "✅ Профиль обновлён: " . $email;
}