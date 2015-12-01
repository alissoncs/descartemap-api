<?php

define('ROOT', realpath(__DIR__ . "/../") . '/');

if(!file_exists(ROOT . 'vendor/autoload.php')) {
	die('Run \'composer install\'');
}

require_once ROOT . 'vendor/autoload.php';

$app = require ROOT . 'src/app.php';

require ROOT . 'src/site.php';
require ROOT . 'src/api.php';
require ROOT . 'src/manager.php';

$app->run();
