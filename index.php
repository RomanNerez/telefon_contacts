<?php

try {
	require_once __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'app.php';
    require_once ROOT.'app'.DS.'bootstrap.php';
    require_once __DIR__.DS.'config'.DS.'route.php';

} catch (Exception $error) {
    var_dump($error->getMessage());
}

