<?php 

namespace SimpleAuth\Component;

use SimpleAuth\AccessToken;
use SimpleAuth\Client;
use RuntimeException;
use InvalidArgumentException;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class Warder {

	const NAME = 'warder';

	private $token;

	/** @var boolean */
	private $isInitialized = false;

	/**
	 * Somente ... podem consumir
	 * @param  array $grant
	 */
	public function only(array $grant) {

		return function(Request $request, Application $app){

			$token = $app['auth.authenticator']->getAccess();

			return $app['json']->setStatusCode(403);

		};

	}

	public function not(array $grant) {

		if($this->isInitialized == false) {
			throw new RuntimeException('Warder was not initialized');
		}

		return function(){

			return null;
			
		};

	}

}