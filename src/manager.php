<?php

$manager = $app['controllers_factory'];

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => ROOT . 'view/manager/',
    'twig.options' => [
    	'cache' => ROOT . 'var/twig'
    ]
));

$manager->get('/login', function() use (&$app){

  return $app['twig']->render('login.html');

});

$manager->post('/login', function() use (&$app){

	$login = $app['request']->request->get('login');
	$pass = $app['request']->request->get('pass');

	if($login == 'owyxl1' && $pass == '1lx98154') {
		$app['session']->set('user', md5($login.$pass));
		return $app->redirect('/manager');
	} else {
		return $app->redirect('/manager/login');
	}

});

$manager->get('/logout', function() use (&$app) {

	$app['session']->remove('user');
	return $app->redirect('/manager/login');

});

$manager->get('/', function() use (&$app){

  return $app['twig']->render('index.html');

});

$app->mount('/manager', $manager);
