<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;

use Provider\RepositoryCollectionProvider;
use Provider\MongoConnectionProvider;

$app = new Application();

// Serviço de repositórios
$app->register(new RepositoryCollectionProvider());

// Serviço do Mongo
$app->register(new MongoConnectionProvider());

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

return $app;
