<?php
require 'Csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Csrf::check($_POST['csrf_token'] ?? '')) {
        http_response_code(403);
        die('CSRF validation failed');
    }

    echo "Профиль обновлён: " . htmlspecialchars($_POST['email']);
}