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

$app->get('/types', function () use ($app) {

  $in = [
    'ALL' => 'Todos',
    'COOK_OIL' => 'Óleo de cozinha',
    'HOSPITAL' => 'Hospitalar',
    'BATTERY' => 'Baterias/Pilhas',
    'ELETRONIC' => 'Eletrônicos',
    'RECYCLING' => 'Reciclagem',
    'OTHER' => 'Outros'
  ];

  $data = array();

  foreach($in as $index => $value) {
    $data[] = ['alias' => $index, 'name' => $value];
  }

  return $app['json']->setData($data);

});

$app->get('/places/{id}', function($id) use ($app) {

    $json = $app['service.place']->findOne($id);

    $parse = $app['serializer']->serialize($json, 'json');

    return $app['json']->setContent($parse)->setStatusCode(200);

});

$app->delete('/places/{id}', function($id) use ($app) {

    if($app['service.place']->delete($id) == true) {

      return $app['json']->setStatusCode(202);

    } else {

      return $app['json']->setStatusCode(500);

    }

});

$app->get('/places', function () use ($app) {

    $json = $app['service.place']->findAll();

    $parse = $app['serializer']->serialize($json, 'json');

    return $app['json']->setContent($parse);

});

$app->post('/places', function () use ($app) {

    $app['service.place']->insert($app['data']);

    return $app['json']->setStatusCode(201);

});

$app->put('/places/{id}', function ($id) use ($app) {

    $app['service.place']->update($id, $app['data']);

    return $app['json']->setStatusCode(202);

});
