<?php 

use SimpleAuth\AccessToken as a;

class AccessTokenTest extends BaseTest {

	/**
	 */
	public function testInstance() {

		$this->assertInstanceOf('SimpleAuth\AccessToken', new a);		

	}

	/**
	 * Testa token gerado
	 */
	public function testGenTokenMethodMustReturnAValidToken() {

		$token = a::genToken();

		$this->assertRegExp('/^[a-f0-9]{32}$/i', $token);

	}

	public function testCreateAndGetterMethods() {

		$a = a::create([
			'id' => 1,
			'token' => '321',
			'refresh_token' => '123',
			'grant_type' => 1,
			'status' => 'vazio',
			'expires' => 154648
		]);

		$this->assertEquals(1, $a->getId());
		$this->assertEquals('321', $a->getToken());
		$this->assertEquals('123', $a->getRefreshToken());
		$this->assertEquals('vazio', $a->getStatus());
		$this->assertEquals(154648, $a->getExpires());

	}

}