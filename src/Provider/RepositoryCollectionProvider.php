<?php 

namespace Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Service\PlaceService;

class RepositoryCollectionProvider implements ServiceProviderInterface {

    public function register(Application $app) {

        $app['service.place'] = $app->share(function(){
          
          return new PlaceService();

        });

    }

    public function boot(Application $app) {

    }

}