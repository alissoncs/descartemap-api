<?php 

namespace SimpleAuth;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="access_clients")
 */
class Client {

	/**
	 * @ODM\Id
     */
	private $id;

	/**
	 * @ODM\String
     */
	private $token;

	/**
	 * @ODM\String
     */
	private $refresh_token;

	/**
	 * @ODM\Boolean
     */
	private $status = true;

	/**
	 * @ODM\String
     */
	private $expires;

	/**
	 * @ODM\Date
	 */
	private $create_date;

	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	public function setToken($token) {
		$this->token = $token;
	}
	public function getToken() {
		return $this->token;
	}
	public function setRefreshToken($refresh_token) {
		$this->refresh_token = $refresh_token;
	}
	public function getRefreshToken() {
		return $this->refresh_token;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setExpires($expires) {
		$this->expires = $expires;
	}
	public function getExpires() {
		return $this->expires;
	}

	static public function create(array $data, $client = null) {
		if($client == null)
			$client = new self;

		if(isset($data['id'])) {
			$client->setId($data['id']);
		}
		if(isset($data['token'])) {
			$client->setToken($data['token']);
		}
		if(isset($data['refresh_token'])) {
			$client->setRefreshToken($data['refresh_token']);
		}

		return $client;

	}

	static public function genToken() {
		
		return md5(uniqid(rand(), true));

	}

}