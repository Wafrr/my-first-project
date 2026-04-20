<?php
// Задания 63-64:
// 63) Сделайте функцию, которая принимает число и проверяет, что все его цифры нечетные.
// 64) Сделайте функцию, которая принимает год и проверяет, високосный он или нет.

function hasOnlyOddDigits(int $var1): bool
{
    $var1 = abs($var1);
    if ($var1 === 0) {
        return false;
    }

    while ($var1 > 0) {
        $var2 = $var1 % 10;
        if ($var2 % 2 === 0) {
            return false;
        }
        $var1 = intdiv($var1, 10);
    }

    return true;
}

function isLeapYear(int $var3): bool
{
    return ($var3 % 400 === 0) || ($var3 % 4 === 0 && $var3 % 100 !== 0);
}

echo "63) Только нечетные цифры (13579): " . (hasOnlyOddDigits(13579) ? 'true' : 'false') . "<br>";
echo "64) 2024 високосный: " . (isLeapYear(2024) ? 'true' : 'false') . "<br>";
