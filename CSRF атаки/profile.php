<?php
require 'Csrf.php';
?>

<h2>Обновить профиль</h2>

<form method="POST" action="update.php">
    <?php echo Csrf::field(); ?>
    <input type="email" name="email" placeholder="Email">
    <button>Обновить</button>
</form>