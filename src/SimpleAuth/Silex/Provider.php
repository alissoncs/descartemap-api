<?php 

namespace SimpleAuth\Silex;

use Silex\ServiceProviderInterface;
use Silex\Application;

class Provider implements ServiceProviderInterface {

	const PREFIX = 'auth.';

    public function register(Application $app) {

    	$app[self::PREFIX . 'debug'] = $app['debug'];

    	$app[self::PREFIX . 'auth'] = $app->share(function(){
    		return 'sample authentication';
    	});

    }

    public function boot(Application $app) {

    }

}