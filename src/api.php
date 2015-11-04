<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\json;
use Symfony\Component\HttpFoundation\Jsonjson;
use Symfony\Component\HttpFoundation\Redirectjson;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Service\PlaceService;

$app->get('/', function () use ($app) {
    return $app['json']->setData(['sample' => 1]);
});

$app->get('/places/{id}', function($id) use ($app) {
    
    $sv = new PlaceService;
    $json = $sv->getOne($app);

    return $app['json']->setData($json); 

});

$app->get('/places', function () use ($app) {
    
    $json = $app['service.place']->findAll();

    return $app['json']->setData($json); 

});

$app->error(function (\Exception $e, $code) use ($app) {

    if ($app['debug']) {
        return;
    }

    return $app['json']->setData(['error' => true])->setStatusCode(500); 

});
