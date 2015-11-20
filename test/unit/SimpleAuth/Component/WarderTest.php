<?php 

use SimpleAuth\Component\Warder as w;

use SimpleAuth\AccessToken;
use SimpleAuth\Client;

class WarderTest extends BaseTest {

	const CLASSNAME = 'SimpleAuth\Component\Warder';

	public function setUp() {
		parent::setUp();
		$this->instance = new w(new AccessToken, new Client);
	}

	private function accessTokenMock($grant) {
		$mock = $this->getMockBuilder('SimpleAuth\AccessToken')->getMock();
		$mock->method('getGrantType')->willReturn($grant);
		return $mock;
	}

	public function testInstance() {
		$this->assertInstanceOf(self::CLASSNAME, $this->instance);
	}

	public function testOnlyReturnClosure() {

		$return = $this->instance->only([]);
		$this->assertInstanceOf('Closure', $return);

	}

	public function testNotReturnClosure() {

		$return = $this->instance->not([]);
		$this->assertInstanceOf('Closure', $return);

	}

}