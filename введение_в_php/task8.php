<?php
// Задания 23-28:
// 23) Дана строка 'php'. Сделайте из нее строку 'PHP'.
// 24) Дана строка 'london'. Сделайте из нее строку 'London'.
// 25) Дана строка 'London'. Сделайте из нее строку 'london'.
// 26) Дана строка 'html css php'. Найдите количество символов в этой строке.
// 27) Проверить длину пароля: если >5 и <10, то пароль подходит.
// 28) Проверить, что строка заканчивается на '.png'.

$var1 = 'php';
echo "23) " . strtoupper($var1) . "<br>";

$var1 = 'london';
echo "24) " . ucfirst($var1) . "<br>";

$var1 = 'London';
echo "25) " . strtolower($var1) . "<br>";

$var1 = 'html css php';
echo "26) Длина: " . strlen($var1) . "<br>";

$var2 = 'qwerty7';
if (strlen($var2) > 5 && strlen($var2) < 10) {
    echo "27) Пароль подходит<br>";
} else {
    echo "27) Придумайте другой пароль<br>";
}

$var3 = 'image.png';
echo "28) " . (str_ends_with($var3, '.png') ? 'да' : 'нет') . "<br>";
