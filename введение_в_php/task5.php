<?php
// Задания 14-15:
// 14) Если isAdmin=true, вывести div с приветствием админа и кнопкой входа в панель; иначе span с текстом "У вас нет прав доступа".
// 15) Сайт поддерживает 3 языка (ru, en, de). В зависимости от $lang вывести фразу на нужном языке, используя switch-case.

const isAdmin = true;
$lang = 'de';

if (isAdmin) {
    echo '<div class="admin-block">Привет, Админ сайта! <button>Войти в панель управления</button></div>';
} else {
    echo '<span class="no-access"><b>У вас нет прав доступа</b></span>';
}

echo '<hr>';

switch ($lang) {
    case 'ru':
        echo 'Добро пожаловать!';
        break;
    case 'en':
        echo 'Welcome!';
        break;
    case 'de':
        echo 'Willkommen!';
        break;
    default:
        echo 'Язык не поддерживается';
}
