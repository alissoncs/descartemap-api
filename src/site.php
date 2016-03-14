<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\json;
use Symfony\Component\HttpFoundation\Jsonjson;
use Symfony\Component\HttpFoundation\Redirectjson;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Silex\Application;

use Service\PlaceService;

$site = $app['controllers_factory'];

$site->before(function(Request $req, Application $app){

	$app['twig.path'] = ROOT . 'view/site/';

});

$site->match('/', function() use(&$app){

	// Busca quantidade de cidades
	return $app['twig']->render('index.html');

});

$app->mount('/', $site);