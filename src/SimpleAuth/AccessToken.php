<?php 

namespace SimpleAuth;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use SimpleAuth\Client;
use SimpleAuth\Grant;

/**
 * @ODM\Document(collection="auth_tokens")
 */
class AccessToken {

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
	 * @ODM\Integer(name="grant_type")
	 * @var int
	 */
	private $grantType = Grant::LEVEL_1;

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

	public function setGrantType($grant) {

		if(!Grant::isValid($grant)) {
			throw new InvalidArgumentException('Grant type isn\'t valid');
		}

		$this->grantType = $grant;

	}

	static public function create(array $data, $self = null) {
		if($self == null)
			$self = new self;

		if(isset($data['id'])) {
			$self->setId($data['id']);
		}
		if(isset($data['token'])) {
			$self->setToken($data['token']);
		}
		if(isset($data['refresh_token'])) {
			$self->setRefreshToken($data['refresh_token']);
		}
		if(isset($data['grant_type'])) {
			$self->setGrantType($data['grant_type']);
		}
		if(isset($data['status'])) {
			$self->setStatus($data['status']);
		}
		if(isset($data['expires'])) {
			$self->setExpires($data['expires']);	
		}

		return $self;

	}

	static public function genToken() {
		
		return md5(uniqid(rand(), true));

	}

}