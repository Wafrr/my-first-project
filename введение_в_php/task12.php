<?php
// Задания 41-42:
// 41) Дана строка 'abcde'. Получите массив букв этой строки.
// 42) Дан массив со строками. Оставьте только строки, которые начинаются на http://.

$var1 = 'abcde';
$var2 = str_split($var1);
echo "41) ";
print_r($var2);
echo "<br>";

$var3 = ['http://site.ru', 'https://site.ru', 'http://abc.com', 'ftp://x'];
$var4 = [];
foreach ($var3 as $var5) {
    if (str_starts_with($var5, 'http://')) {
        $var4[] = $var5;
    }
}
echo "42) ";
print_r($var4);
