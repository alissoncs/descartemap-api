<?php 

namespace Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use MongoClient;
use RuntimeException;

class MongoConnectionProvider implements ServiceProviderInterface {

    public function register(Application $app) {

        if(!class_exists('MongoClient')) {
          throw new RuntimeException('MongoClient extension is not available');
        }

        $app['mongo.client'] = $app->share(function(){

          $client = new MongoClient();

          return $client;

        });

        $app['mongo.db'] = $app->share(function() use(&$app) {

          return $app['mongo.client']->selectDB('descartemap');            

        });

    }

    public function boot(Application $app) {

      $app['mongo.is_connected'] = true;

    }

}