<?php 

use SimpleAuth\Component\Warder as w;

use SimpleAuth\AccessToken;
use SimpleAuth\Client;

class WarderTest extends BaseTest {

	const CLASSNAME = 'SimpleAuth\Component\Warder';

	public function setUp() {
		parent::setUp();
		$this->instance = new w();
	}

	private function accessTokenMock($grant = null) {
		$mock = $this->getMockBuilder('SimpleAuth\AccessToken')->getMock();
		$mock->method('getGrantType')->willReturn($grant);
		return $mock;
	}

	public function testInstance() {
		$this->assertInstanceOf(self::CLASSNAME, $this->instance);
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testUsingMethodOnlyWithoutInitialize() {

		$return = $this->instance->only([]);
		$this->assertInstanceOf('Closure', $return);

	}
	/**
	 * @expectedException RuntimeException
	 */
	public function testUsingMethodNotWithoutInitialize() {

		$return = $this->instance->not([]);
		$this->assertInstanceOf('Closure', $return);

	}

	public function testOnlyReturnClosure() {

		$this->instance->initialize($this->accessTokenMock());
		$return = $this->instance->only([]);
		$this->assertInstanceOf('Closure', $return);

	}

	public function testNotReturnClosure() {

		$this->instance->initialize($this->accessTokenMock());
		$return = $this->instance->not([]);
		$this->assertInstanceOf('Closure', $return);

	}

	public function testInitializingWarderWithAnAccessToken() {

		$this->instance->initialize($this->accessTokenMock());

	}

}