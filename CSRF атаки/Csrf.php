// token() — создаёт случайный токен и сохраняет в сессии
// check() — безопасно сравнивает токен из запроса с токеном в сессии
// field() — вставляет скрытое поле с токеном в форму
<?php
session_start();

class Csrf {

    // Генерация токена и сохранение в сессии
    public static function token() {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf'];
    }

    // Проверка токена из формы
    public static function check($token) {
        return isset($_SESSION['csrf']) &&
               hash_equals($_SESSION['csrf'], $token);
    }

    // Вставка токена в HTML-форму
    public static function field() {
        return '<input type="hidden" name="csrf_token" value="' . self::token() . '">';
    }
}