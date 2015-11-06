<?php

namespace Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use RuntimeException;

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

class MongoConnectionProvider implements ServiceProviderInterface {

    public function register(Application $app) {

      $app['mongo.dm'] = $app->share(function() {

        AnnotationDriver::registerAnnotationClasses();

        $config = new Configuration();
        $config->setProxyDir(ROOT . '/var/proxies');
        $config->setProxyNamespace('Proxies');
        $config->setHydratorDir(ROOT . '/var/hydrators');
        $config->setHydratorNamespace('Hydrators');
        $config->setMetadataDriverImpl(AnnotationDriver::create(ROOT . '/var/cache'));

        $dm = DocumentManager::create(new Connection(), $config);

        return $dm;

      });

    }

    public function boot(Application $app) {

      $app['mongo.is_connected'] = true;

    }

}
