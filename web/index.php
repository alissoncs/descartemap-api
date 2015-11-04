<?php

if(!file_exists(__DIR__.'/../vendor/autoload.php')) {
	die('Run \'composer install\'');
}

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/api.php';

error_reporting(E_ALL);
$app['debug'] = true;

require __DIR__.'/../src/controllers.php';

$app->run();