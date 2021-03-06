<?php 

namespace Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Service\PlaceService;
use Service\AuthService;
use Service\MaterialService;

class RepositoryCollectionProvider implements ServiceProviderInterface {

    public function register(Application $app) {

    	$app['service.auth'] = $app->share(function() use(&$app){
          
          return new AuthService($app);

        });

        $app['service.place'] = $app->share(function() use(&$app){
          
          return new PlaceService($app);

        });

        $app['service.material'] = $app->share(function() use(&$app){
          
          return new MaterialService($app);

        });

    }

    public function boot(Application $app) {

    }

}