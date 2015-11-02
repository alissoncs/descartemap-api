<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Service\PlaceService;

$app->get('/', function () use ($app) {
    return $app['response']->setContent(['sample' => 1]);
});

$app->get('/places/{id}', function($id) use ($app) {
    
    $sv = new PlaceService;
    $json = $sv->getOne($app);

    return $app['response']->setData($json); 

});

$app->get('/places', function () use ($app) {
    
    $sv = new PlaceService;
    $json = $sv->getAll($app);

    return $app['response']->setData($json); 

});

$app->error(function (\Exception $e, $code) use ($app) {

    if ($app['debug']) {
        return;
    }

    return $app['response']->setData(['error' => true])->setStatusCode(500); 

});
