<?php 

namespace Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class MongoConnectionProvider implements ServiceProviderInterface {

    public function register(Application $app) {

        $app['mongo.client'] = $app->share(new MongoClient());

        $app['mongo.db'] = $app->share(function() use(&$app) {

          return $app['mongo.client']->selectDB('descartemap');            

        });

    }

    public function boot(Application $app) {

      $app['mongo.is_connected'] = true;

    }

}