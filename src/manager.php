<?php

$manager = $app['controllers_factory'];

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => ROOT . 'view/manager/',
));

$manager->get('/', function() use (&$app){

  return $app['twig']->render('index.html');

});

$app->mount('/manager', $manager);
