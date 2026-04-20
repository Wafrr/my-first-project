<?php
require 'Csrf.php';
?>

<h2>Список объявлений (GET /ads)</h2>
<p> Этот маршрут не требует CSRF-защиты, так как не изменяет данные.</p>

<h2>➕ Создать объявление (POST /ads/create)</h2>
<form method="POST" action="create.php">
    <?php echo Csrf::field(); ?>
    <input type="text" name="title" placeholder="Заголовок" required>
    <button>Создать</button>
</form>