<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Provider\RepositoryCollectionProvider;
use Provider\MongoConnectionProvider;

use Sirius\Validation\Validator;

use Exception\ValidationException;
use Exception\NotFoundException;

$app = new Application();

// Serviço de repositórios
$app->register(new RepositoryCollectionProvider());

// Serviço do Mongo
$app->register(new MongoConnectionProvider());

// Validator
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app['debug'] = !file_exists(ROOT . 'production');

$app['serializer'] = $app->share(function(){

  $encoders = array(new XmlEncoder(), new JsonEncoder());
  $normalizers = array(new ObjectNormalizer());

  return new Serializer($normalizers, $encoders);

});

$app['session'] = $app->share(function(){
  $session = new Session();
  $session->start();
  return $session;
});

$app['validator'] = function(){

  return new Validator;

};

// Retorna array com request
$app['data'] = function() use(&$app) {

  $raw = $app['request']->getContent();

  if(!empty($raw)) {
    $raw = json_decode($raw, true);
  }

  if(empty($raw)) {

    $raw = $app['request']->request->all();

  }

  return $raw;

};

$app->before(function() use (&$app){

  if($app['request']->getPathInfo() === "/api/token") {
    return;
  }

  // Login no manager não pode ter acesso
  if($app['request']->getPathInfo() === "/manager/login") {
    return;
  }

  // Caso tenha um usuário na sessão, deixa acessar
  if($app['session']->has('user')) {
    return;
  }

  $token = $app['request']->headers->get("Authorization");

  // Caso não tenha Token
  if($token == null) {
    return $app['json']->setStatusCode(403);
  }

  // Permissão via Token
  if(!$app['service.auth']->isAllowed($token)) {
    return $app['json']->setStatusCode(403);
  }

});

// Json
$app['json'] = $app->share(function(){
  return new JsonResponse;
});

// Faker
$app['faker'] = $app->share(function(){

  $faker = \Faker\Factory::create('pt_BR');
  $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
  $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
  $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));

  return $faker;

});

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => ROOT . 'view/manager/',
    'twig.options' => [
      'cache' => ROOT . 'var/twig'
    ]
));

$app->error(function(\Exception $e, $code) use (&$app){

  if($e instanceof ValidationException) {

    return $app['json']
    ->setData($e->getErrors())
    ->setStatusCode(422);

  } else if($e instanceof NotFoundException) {

    return $app['json']
    ->setStatusCode(404);

  } else {

    if($app['debug'])
      return $e->getMessage() . PHP_EOL . $e->getCode() . PHP_EOL . $e->getTraceAsString();
    else 
      return $app['json']
      ->setContent("Erro")
      ->setStatusCode(500);

  }

});

return $app;
