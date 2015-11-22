<?php 

namespace SimpleAuth\Component;

use Doctrine\ODM\MongoDB\DocumentManager as Mongo;
use Symfony\Component\HttpFoundation\Request as Request;
use InvalidArgumentException;

/**
 * Componente que verifica existência de elementos
 */
class Authenticator {

	const NAME = 'authenticator';

	/** @var AccessToken */
	private $accessToken;

	/** @var Mongo */
	private $manager = null;

	public function __construct(Mongo &$manager) {

		$this->manager =& $manager;

	}

	/**
	 * Retorna um token de accesso com base na conexão
	 * @param  string $token
	 * @return null|AccessToken
	 */
	public function getAccess($token = null) {

		if(null != $this->accessToken && $token == null) {

			return $this->accessToken;

		}

		if(!is_string($token)) {
			throw new InvalidArgumentException('Token must be string');
		}

		// Limpa o Basic do token
		$token = $this->flushToken($token);

		// Consulta no banco

		return null;

	}

	public function createAccess($grantType) {


	}

	public function flushToken($token) {

		$token = trim($token);

		$token = preg_replace('/^([A-z]+ |)(.*)$/', '$2', $token);

		return $token;
	}

}