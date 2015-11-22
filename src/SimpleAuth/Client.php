<?php 

namespace SimpleAuth;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use InvalidArgumentException;

/**
 * @ODM\Document(collection="auth_clients")
 */
class Client {

	/**
	 * @ODM\Id
     */
	private $id;

	/**
	 * @ODM\String
     */
	private $name;

	/**
	 * @ODM\String
     */
	private $secret;

	/**
	 * @ODM\Int(name="grant_type")
     */
	private $grantType = 0;

	public function __construct() {

	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setSecret($secret) {
		$this->secret = $secret;
	}

	public function getSecret() {
		return $this->secret;
	}

	public function setGrantType($grant) {

		if(!is_int($grant)) {
			throw new InvalidArgumentException('Grant type Must be int');
		}

		if($grant < 1 || $grant > 5) {
			throw new InvalidArgumentException('Grant type not exists');
		}

		$this->grantType = $grant;

	}

}