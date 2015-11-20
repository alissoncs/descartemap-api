<?php 

namespace SimpleAuth\Component;

use SimpleAuth\AccessToken;
use SimpleAuth\Client;

class Warder {

	private $client;

	private $token;

	public function __construct(AccessToken $token, Client $client) {

		$this->client = $client;
		$this->token = $token;

	}

	/**
	 * Somente ... podem consumir
	 * @param  array $grant
	 */
	public function only(array $grant) {

		return function(){

		};

	}

	public function not(array $grant) {

		return function(){
			
		};

	}

}