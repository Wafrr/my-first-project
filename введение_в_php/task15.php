<?php
// Задания 47-49:
// 47) Сформируйте с помощью двух вложенных циклов массив [[1,2],[3,4],[5,6],[7,8]].
// 48) Сформируйте с помощью двух вложенных циклов массив [[1,2,3,4,5],[1,2,3,4,5],[1,2,3,4,5]].
// 49) С помощью двух вложенных циклов выведите элементы массива групп в формате "имя группы - имя юзера".

$var1 = [];
$var2 = 1;
for ($var3 = 0; $var3 < 4; $var3++) {
    for ($var4 = 0; $var4 < 2; $var4++) {
        $var1[$var3][$var4] = $var2++;
    }
}
echo "47) ";
print_r($var1);
echo "<br>";

$var5 = [];
for ($var3 = 0; $var3 < 3; $var3++) {
    for ($var4 = 0; $var4 < 5; $var4++) {
        $var5[$var3][$var4] = $var4 + 1;
    }
}
echo "48) ";
print_r($var5);
echo "<br>";

$var6 = [
    'group1' => ['user11', 'user12', 'user13', 'user43'],
    'group2' => ['user21', 'user22', 'user23'],
    'group3' => ['user31', 'user32', 'user33'],
    'group4' => ['user41', 'user42', 'user43'],
    'group5' => ['user51', 'user52'],
];

echo "49)<br>";
foreach ($var6 as $var7 => $var8) {
    foreach ($var8 as $var9) {
        echo "$var7 - $var9<br>";
    }
}
