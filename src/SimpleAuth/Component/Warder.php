<?php 

namespace SimpleAuth\Component;

use SimpleAuth\AccessToken;
use SimpleAuth\Client;
use RuntimeException;

class Warder {

	const NAME = 'warder';

	private $token;

	/** @var boolean */
	private $isInitialized = false;

	public function initialize(AccessToken $token) {

		$this->isInitialized = true;

		$this->token = $token;

	}

	/**
	 * Somente ... podem consumir
	 * @param  array $grant
	 */
	public function only(array $grant) {

		if($this->isInitialized == false) {
			throw new RuntimeException('Warder was not initialized');
		}

		return function(){

		};

	}

	public function not(array $grant) {

		if($this->isInitialized == false) {
			throw new RuntimeException('Warder was not initialized');
		}

		return function(){
			
		};

	}

}