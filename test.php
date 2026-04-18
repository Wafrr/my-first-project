<?php
echo 'Hi'   ;

$name = "Petrov";
echo $name;

$number1 = 14;
$number2 = 12;
$result = $number1 + $number2;
echo $result;

$capital = "Paris";
echo "The capital of France is", $capital,"<br/>";

$capital = "Paris";
echo "The capital of France is $capital <br/>";


$apple = 5;
$fruit = "apple";
echo $$fruit;

echo ${$fruit};

$bool = TRUE;
$int = 100;
$string = "This is text";
$string2 = "1234";
!$flout = 44.32;

$str = "500";
$new_str = (integer) $str;
echo $new_str + $str; //будет 1000, тк числа могут работать со строками

// + , -, %, *, /

echo "round(4.2) = ", round(4.2), "<br>";

$d = 'dir d:\\';
echo $d;


?>