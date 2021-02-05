<?php

ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__).DS);
define('ROOT_APP', ROOT.'app'.DS);
define('ROOT_APP_CORE', ROOT_APP.'core'.DS);
define('ROOT_PUBLIC', ROOT.'public'.DS);

define('HOST', 'http://'.$_SERVER['HTTP_HOST']);

define('DATABASE', 'mysql');
define('DB_NAME', 'application');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');