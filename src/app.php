<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Provider\RepositoryCollectionProvider;
use Provider\MongoConnectionProvider;

use Exception\ValidationException;
use Exception\NotFoundException;

$app = new Application();

// Serviço de repositórios
$app->register(new RepositoryCollectionProvider());

// Serviço do Mongo
$app->register(new MongoConnectionProvider());

// Validator
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app['debug'] = true;

$app['serializer'] = $app->share(function(){

  $encoders = array(new XmlEncoder(), new JsonEncoder());
  $normalizers = array(new ObjectNormalizer());

  return new Serializer($normalizers, $encoders);

});

// Retorna array com request
$app['data'] = function() use(&$app) {

  $raw = $app['request']->getContent();

  if(!empty($raw)) {
    $raw = json_decode($raw, true);
  }

  if(empty($raw)) {

    $raw = $this->request->all();

  }

  return $raw;

};

// Json
$app['json'] = $app->share(function(){
  $r = new JsonResponse;
  return $r;
});

// Faker
$app['faker'] = $app->share(function(){

  $faker = \Faker\Factory::create('pt_BR');
  $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
  $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
  $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));

  return $faker;

});

$app->error(function(\Exception $e, $code) use (&$app){

  if($e instanceof ValidationException) {

    return $app['json']
    ->setData($e->getErrors())
    ->setStatusCode(422);

  } else if($e instanceof NotFoundException) {

    return $app['json']
    ->setStatusCode(404);

  } else {

    return $e->getMessage() . PHP_EOL . $e->getCode() . PHP_EOL . $e->getTraceAsString();

  }

});

return $app;
