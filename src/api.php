<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\json;
use Symfony\Component\HttpFoundation\Jsonjson;
use Symfony\Component\HttpFoundation\Redirectjson;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Service\PlaceService;

$api = $app['controllers_factory'];

$api->get('/', function () use ($app) {
    return $app['json']->setData([
      'now' => new \DateTime()
    ]);
});

$api->post('/token', function() use(&$app) {

  $clientData = $app['data'];

  if(!isset($clientData['id']) || !isset($clientData['secret'])) {
   
    return $app['json']->setData(['error' => 'Required id and secret'])
    ->setStatusCode(400);  

  }

  $id = $clientData['id'];
  $secret = $clientData['secret'];

  if($id !== '324' && $secret !== '54') {
    return $app['json']->setData(['error' => 'Client not found'])
    ->setStatusCode(404);  
  }

  $token = $app['service.auth']->generate();

  return $app['json']->setData($token);

});

$api->get('/types', function () use ($app) {

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

$api->get('/materials', function() use(&$app){

  $data = $app['service.material']->findAll();

  return $app['json']->setData($data);

});

$api->get('/places', function () use ($app) {

    $query = $app['request']->query->all();

    $json = $app['service.place']->findAll($query, true);

    return $app['json']->setData($json);

});

$api->get('/places/{id}', function($id) use ($app) {

    $json = $app['service.place']->findOne($id, true);

    return $app['json']->setData($json)->setStatusCode(200);

});

$api->post('/places', function () use ($app) {

    $created = $app['service.place']->insert($app['data']);

    if($created == null)
      return $app['json']->setStatusCode(500);

    return $app['json']->setStatusCode(201)
    ->setData(['id' => $created->getId()]);

});

$api->put('/places/{id}', function ($id) use ($app) {

    // Somente avaliação
    if($app['request']->query->get('avaliate') != null) {
      
      $app['service.place']->avaliate($id, $app['request']->query->get('avaliate'));

      return $app['json']->setStatusCode(202);
    }

    $app['service.place']->update($id, $app['data']);

    return $app['json']->setStatusCode(202);

});

$api->delete('/places/{id}', function($id) use ($app) {

    if($app['service.place']->delete($id) == true) {

      return $app['json']->setStatusCode(202);

    } else {

      return $app['json']->setStatusCode(500);

    }

});


$app->mount('/api', $api);