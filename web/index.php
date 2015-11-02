<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';

error_reporting(E_ALL);
$app['debug'] = true;

require __DIR__.'/../src/controllers.php';

$app->run();