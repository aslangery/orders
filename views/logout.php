<?php if(!defined('APP')) die();?>
<form action="index.php?task=user.logout" method="post">
    <label>Имя пользователя:</label><?php echo $vars['username']; ?>
    <button type="submit">Выход</button>
</form>
