<?php
// Задания 56-58:
// 56) Сделайте функцию, которая параметром принимает число и выводит куб этого числа.
// 57) Сделайте функцию, которая принимает число и выводит '+++' для положительного и '---' для отрицательного.
// 58) Сделайте функцию, которая принимает 3 числа и выводит их сумму.

function showCube(int|float $var1): void
{
    echo "56) Куб $var1 = " . ($var1 ** 3) . "<br>";
}

function showSign(int|float $var1): void
{
    echo "57) " . ($var1 >= 0 ? '+++' : '---') . "<br>";
}

function showSum3(int|float $var2, int|float $var3, int|float $var4): void
{
    echo "58) Сумма = " . ($var2 + $var3 + $var4) . "<br>";
}

showCube(4);
showSign(-2);
showSum3(1, 5, 9);
