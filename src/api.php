<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\json;
use Symfony\Component\HttpFoundation\Jsonjson;
use Symfony\Component\HttpFoundation\Redirectjson;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Service\PlaceService;

$app->get('/', function () use ($app) {
    return $app['json']->setData([
      'now' => new \DateTime()
    ]);
});

$app->post('/token', function() use(&$app) {

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

$app->get('/materials', function() use(&$app){

  $in = [
    'Papelão',
    'Caixa de leite',
    'Garrafas pet',
    'Frascos de produtos',
    'Tubos PVC',
    'Caneta sem tinta',
    'Jornais e revistas',
    'Listas telefônicas',
    'Papel Sulfite',
    'Papel',
    'Caixas',
    'Adesivos',
    'Garrafas de vidro',
    'Tampa de garrafa',
    'Latinhas',
    'Panelas',
    'Ferragens',
    'Pregos',
    'Papel alumínio limpo',
    'Clipes',
    'Grampos',
    'Solventes',
    'Alumínio',
    'Cobre',
    'Lâmpada',
    'Cartucho de impressora',
    'Gesso',
    'Galhos',
    'Pneu',
    'Plásticos',
    'Móveis',
    'Caliça'
  ];

  $data = array();
  foreach($in as $index => $value) {
    $data[] = ['ref' => $index, 'name' => $value];
  }

  return $app['json']->setData($data);


});

$app->get('/places', function () use ($app) {

    $query = $app['request']->query->all();

    $json = $app['service.place']->findAll($query, true);

    return $app['json']->setData($json);

});

$app->get('/places/{id}', function($id) use ($app) {

    $json = $app['service.place']->findOne($id, true);

    return $app['json']->setData($json)->setStatusCode(200);

});

$app->post('/places', function () use ($app) {

    $created = $app['service.place']->insert($app['data']);

    if($created == null)
      return $app['json']->setStatusCode(500);

    return $app['json']->setStatusCode(201)
    ->setData(['id' => $created->getId()]);

});

$app->put('/places/{id}', function ($id) use ($app) {

    $app['service.place']->update($id, $app['data']);

    return $app['json']->setStatusCode(202);

});

$app->delete('/places/{id}', function($id) use ($app) {

    if($app['service.place']->delete($id) == true) {

      return $app['json']->setStatusCode(202);

    } else {

      return $app['json']->setStatusCode(500);

    }

});
