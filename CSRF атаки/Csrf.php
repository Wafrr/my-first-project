<?php
// Файл: Csrf.php
// Назначение: защита от CSRF-атак через токен в сессии

session_start();

class Csrf {

    /**
     * Генерирует или возвращает существующий CSRF-токен.
     * Токен хранится в сессии (не в БД) для производительности
     * и привязки к конкретному пользователю.
     */
    public static function token(): string {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Проверяет токен из запроса.
     * Использует hash_equals() для защиты от timing-атак.
     */
    public static function check(string $token): bool {
        return !empty($_SESSION['csrf_token']) &&
               hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Вставляет скрытое поле с токеном в любую HTML-форму.
     * Это обязательный элемент для всех форм, изменяющих данные.
     */
    public static function field(): string {
        return '<input type="hidden" name="csrf_token" value="' . self::token() . '">';
    }
}