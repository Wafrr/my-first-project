<?php

echo "========== Задание 1 ==========\n\n";
$age = 25; 
echo "Возраст: $age\n";

if ($age >= 18 && $age <= 35) {
    echo "Счастливчик!\n";
} elseif ($age >= 1 && $age <= 17) {
    echo "Слишком молод\n";
} else {
    echo "Не повезло\n";
}



echo "\n========== Задание 2 ==========\n\n";
$evenNumbers = [];
for ($i = 1; $i <= 100; $i++) {
    if ($i % 2 == 0) {
        $evenNumbers[] = $i;
    }
}
echo "Массив четных чисел от 1 до 100:\n";
print_r($evenNumbers);
echo "\nЧетные числа, которые делятся на 5:\n";
foreach ($evenNumbers as $number) {
    if ($number % 5 == 0) {
        echo $number . "\n";
    }
}


echo "\n========== Задание 3 ==========\n\n";
$userData = [
    "Name" => "Иван Петров",
    "Address" => "ул. Пушкина, д. 10, кв. 25, Москва",
    "Phone" => "+7 (999) 123-45-67",
    "Mail" => "ivan.petrov@example.com"
];
foreach ($userData as $element => $value) {
    echo "$element: $value\n";
}
?>