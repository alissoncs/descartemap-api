<?php

use Silex\Application as Silex;
use Symfony\Component\HttpFoundation\Request;

$manager = $app['controllers_factory'];

$manager->before(function(Request $request) use ($app) {

	// valida session
	if($request->getRequestUri() !== '/manager/login' && $app['session']->get('user') == null) {
		return $app->redirect('/manager/login');
	}

  $siteName = isset($app['config']['site_name']) ? $app['config']['site_name'] : '';
  $googleMaps = isset($app['config']['google_maps_js']) ? 
                              $app['config']['google_maps_js'] : '';

  $app['twig']->addGlobal('google_maps_token', $googleMaps);
  $app['twig']->addGlobal('site_name', $siteName);

});

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

$manager->get('/retificacoes', function() use (&$app){

	$retifications = $app['service.place']->getWithRetifications();

 return $app['twig']->render('retificacoes.html', array(
 	'retifications' => $retifications
 ));

})->bind('retificacoes');

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
