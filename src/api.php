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

$app->post('/token', function() use(&$app) {

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
    'Solventes'
  ];

  $data = array();
  foreach($in as $index => $value) {
    $data[] = ['ref' => $index, 'name' => $value];
  }

  return $app['json']->setData($data);


});

$app->get('/places', function () use ($app) {

    $json = $app['service.place']->findAll(array(), true);

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
