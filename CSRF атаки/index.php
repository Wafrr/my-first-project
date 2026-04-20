<?php
require 'Csrf.php';
?>

<h2>Создать объявление</h2>

<form method="POST" action="create.php">
    <?php echo Csrf::field(); ?>
    <input type="text" name="title" placeholder="Заголовок">
    <button>Создать</button>
</form>