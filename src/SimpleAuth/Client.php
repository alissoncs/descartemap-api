<?php 

namespace SimpleAuth;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

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
	 * @ODM\Int
     */
	private $grant_type = 2;

	const GRANT_ALL = 1;
	const GRANT_BASIC = 2;
	const GRANT_LEVEL_1 = 3;
	const GRANT_LEVEL_2 = 4;
	const GRANT_LEVEL_3 = 5;

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
			throw new \InvalidArgumentException('Grant type Must be int');
		}

		if($grant < 1 || $grant > 5) {
			throw new \InvalidArgumentException('Grant type not exists');
		}

		$this->grant_type = $grant;

	}

}