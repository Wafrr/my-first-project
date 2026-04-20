<?php
require 'Csrf.php';
?>

<h2>Обновить профиль (POST /profile/update)</h2>
<form method="POST" action="update.php">
    <?php echo Csrf::field(); ?>
    <input type="email" name="email" placeholder="Email" required>
    <button>Обновить</button>
</form>