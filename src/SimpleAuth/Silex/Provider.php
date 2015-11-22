<?php 

namespace SimpleAuth\Silex;

use Silex\ServiceProviderInterface;
use Silex\Application;

use SimpleAuth\Component\Warder as Warder;
use SimpleAuth\Component\Authenticator as Authr;

class Provider implements ServiceProviderInterface {

	const PREFIX = 'auth.';

    public function register(Application $app) {

    	$app[self::PREFIX . 'debug'] = $app['debug'];

    	$app[self::PREFIX . Authr::NAME] = $app->share(function() use(&$app){
    		return new Authr($app['mongo.dm']);
    	});

    	$app[self::PREFIX . Warder::NAME] = $app->share(function(){

    		return new Warder;

    	});

    }

    public function boot(Application $app) {

    }

}