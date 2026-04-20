<?php
// Задания 61-62:
// 61) Функция принимает число и делит его на 2, пока результат не станет меньше 10. Вернуть количество итераций.
// 62) Функция принимает массив и проверяет, что все элементы являются четными числами.

function countDivisionsBy2(float $var1): int
{
    $var2 = 0;
    while ($var1 >= 10) {
        $var1 /= 2;
        $var2++;
    }

    return $var2;
}

function areAllEven(array $var3): bool
{
    foreach ($var3 as $var4) {
        if ($var4 % 2 !== 0) {
            return false;
        }
    }

    return true;
}

echo "61) Итераций: " . countDivisionsBy2(160) . "<br>";
echo "62) Все четные: " . (areAllEven([2, 4, 6, 8]) ? 'true' : 'false') . "<br>";
