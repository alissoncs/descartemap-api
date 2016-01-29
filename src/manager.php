<?php

use Silex\Application as Silex;

$manager = $app['controllers_factory'];

$manager->get('/login', function() use (&$app){

  return $app['twig']->render('login.html');

});

$manager->post('/login', function(Silex $app) use (&$app){

	$login = $app['request']->request->get('login');
	$pass = $app['request']->request->get('pass');

	$users = $app['config']['admin_list'];

	if(isset($users[$login]) && $users[$login] == $pass) {
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

})->bind('manager');

$manager->get('/locais', function() use (&$app){

  return $app['twig']->render('index.html');

})->bind('locais');

$manager->get('/mapa', function() use (&$app){

  return $app['twig']->render('mapa.html');

})->bind('map');

$manager->get('/estatisticas', function() use (&$app){

	// Cidades
	$cities = $app['service.place']->cities();

 return $app['twig']->render('estatisticas.html', array(
 	'cities' => $cities
 ));

})->bind('estatisticas');

$manager->get('/places.json', function() use(&$app) {

	$qb = $app['mongo.dm']
    ->createQueryBuilder('Domain\Place');

	$data = $qb
				->hydrate(false)
    ->getQuery()
    ->execute();

 return $app->json($data->toArray(false), 200);

});

$app->mount('/manager', $manager);
