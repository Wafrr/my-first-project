<?php
// Задания 51-52:
// 51) Напишите скрипт поиска в массиве: вернуть true, если значение найдено в многомерном массиве.
// 52) Напишите скрипт поиска наименьшего элемента в многомерном массиве.

function containsValue(array $var1, int $var2): bool
{
    foreach ($var1 as $var3) {
        foreach ($var3 as $var4) {
            if ($var4 === $var2) {
                return true;
            }
        }
    }

    return false;
}

function findMin(array $var1): int
{
    $var5 = $var1[0][0];

    foreach ($var1 as $var3) {
        foreach ($var3 as $var4) {
            if ($var4 < $var5) {
                $var5 = $var4;
            }
        }
    }

    return $var5;
}

$var6 = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
$var7 = [[3, 7, 2], [9, 4, 6], [1, 8, 5]];

echo "51) Поиск 5: " . (containsValue($var6, 5) ? 'true' : 'false') . "<br>";
echo "52) Минимум: " . findMin($var7) . "<br>";
