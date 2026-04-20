<?php
require 'Csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Проверка CSRF-токена — обязательна для всех POST-запросов,
    // изменяющих состояние сервера. Выполняется ДО любых изменений данных.
    if (!Csrf::check($_POST['csrf_token'] ?? '')) {
        http_response_code(403); // 403 Forbidden — запрос понят, но отклонён
        die('CSRF validation failed');
    }

    // Только после успешной проверки выполняем действие
    echo "Объявление создано: " . htmlspecialchars($_POST['title']);
}
?>