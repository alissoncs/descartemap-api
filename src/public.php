<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\json;
use Symfony\Component\HttpFoundation\Jsonjson;
use Symfony\Component\HttpFoundation\Redirectjson;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Service\PlaceService;

$public = $app['controllers_factory'];

$public->match('/', function() use(&$app){

	return "Web App";

});

$app->mount('/', $public);