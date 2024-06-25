<?php
use RedBeanPHP\R;

require dirname (__DIR__) . '/vendor/autoload.php';
require dirname (__DIR__) . '/src/Helpers/functions.php';
require dirname (__DIR__) . '/src/Config/config.php';
require dirname (__DIR__) . '/src/Helpers/headers.php';
require dirname (__DIR__) . '/src/Config/database.php'; 
require dirname (__DIR__) . '/src/Routes/routes.php';

echo R::testConnection();
exit;