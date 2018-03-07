<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 19:36
 */
session_start();
session_write_close();
define('APP',1);
define('DSN','mysql:dbname=orders;host=127.0.0.1');
define('USER', 'root');
define('PASS', 'root');
spl_autoload_register(function ($class) {
    $path=str_replace('\\','/', $class);
    include $path.'.php';
});
$app=new App();

$app->run();

echo $app->response();


