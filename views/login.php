<?php if(!defined('APP')) die();?>
<form action="index.php?task=user.login" method="post">
    <label>Имя пользователя</label><input type="text" name="username"/>
    <label>Пароль</label><input type="password" name="password"/>
    <button type="submit">Вход</button>
</form>
