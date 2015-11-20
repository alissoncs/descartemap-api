<?php 

namespace SimpleAuth\Component;

class Warder {

	private $grantType;

	private $client;

	private $token;

	/**
	 * Somente ... podem consumir
	 * @param  int|array $grant
	 * @return Handler
	 */
	public function only($grant) {

		return $this;

	}

	public function not($grant) {

		return $this;

	}

}