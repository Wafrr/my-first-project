<?php
// Задание 65:
// С помощью цикла сформируйте HTML-код: <ul><li>1</li>...<li>5</li></ul>.

echo "<ul>";
for ($var1 = 1; $var1 <= 5; $var1++) {
    echo "<li>$var1</li>";
}
echo "</ul>";
