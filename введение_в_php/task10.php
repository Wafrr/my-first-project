<?php
// Задания 34-38:
// 34) Скрипт, который выводит каждый символ строки в отдельной строке.
// 35) Программа, которая выводит строку в обратном порядке.
// 36) Проверка, является ли строка палиндромом без встроенных функций разворота.
// 37) Заменить все пробелы в строке на символ '_'.
// 38) Разбить строку на слова и вывести их в обратном порядке.

$var1 = 'Пример строки';

echo "34) Каждый символ:<br>";
for ($var2 = 0; $var2 < mb_strlen($var1); $var2++) {
    echo mb_substr($var1, $var2, 1) . "<br>";
}

echo "35) В обратном порядке: ";
for ($var2 = mb_strlen($var1) - 1; $var2 >= 0; $var2--) {
    echo mb_substr($var1, $var2, 1);
}
echo "<br>";

$var3 = 'level';
$var4 = true;
for ($var2 = 0, $var5 = strlen($var3) - 1; $var2 < $var5; $var2++, $var5--) {
    if ($var3[$var2] !== $var3[$var5]) {
        $var4 = false;
        break;
    }
}
echo "36) '$var3' палиндром: " . ($var4 ? 'да' : 'нет') . "<br>";

echo "37) " . str_replace(' ', '_', $var1) . "<br>";

$var6 = explode(' ', 'one two three four');
echo "38) " . implode(' ', array_reverse($var6)) . "<br>";
