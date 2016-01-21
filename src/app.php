<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Yaml\Parser;

use Symfony\Component\HttpFoundation\Request;

use Provider\RepositoryCollectionProvider;
use Provider\MongoConnectionProvider;

use SimpleAuth\Silex\Provider as AuthProvider;

use Sirius\Validation\Validator;

use Exception\ValidationException;
use Exception\NotFoundException;

$app = new Application();

// Serviço de repositórios
$app->register(new RepositoryCollectionProvider());

// Serviço do Mongo
$app->register(new MongoConnectionProvider());

// Serviço de autenticação
$app->register(new AuthProvider());

// Debug, caso possua um arquivo production no diretório root
$app['debug'] = !file_exists(ROOT . 'production');

if(!file_exists(ROOT . 'config.yml')) {
  throw new \RuntimeException('config.yml not found', 2);
}

$app['config'] = (new Parser())->parse(file_get_contents(ROOT . 'config.yml'));

// Serviço de session
$app['session'] = $app->share(function(){
  $session = new Session();
  $session->start();
  return $session;
});

// Validador Sirius
$app['validator'] = function(){

  return new Validator;

};

// Dados do array request serializados
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

$app->before(function(Request $request, Application $app) {

  $authStr = $app['request']->headers->get('Authorization');
  $app['auth.authenticator']->getAccess($authStr);

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
