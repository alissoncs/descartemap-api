<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app['response'] = $app->share(function(){
  return new JsonResponse;
});

$app['faker'] = $app->share(function(){

  $faker = \Faker\Factory::create();
  $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
  $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
  $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));

  return $faker;

});

return $app;
