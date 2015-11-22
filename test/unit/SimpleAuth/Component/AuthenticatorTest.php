<?php 

use SimpleAuth\Component\Authenticator as a;
use SimpleAuth\AccessToken;
use SimpleAuth\Client;

use Doctrine\ODM\MongoDB\DocumentManager as Mongo;

class AuthenticatorTest extends BaseTest {

	const CLASSNAME = 'SimpleAuth\Component\Authenticator';

	public function setUp() {
		
		parent::setUp();

		// mock da conexão mongo
		$mongo = $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
		->disableOriginalConstructor()
		->getMock();
		$this->instance = new a($mongo);

	}

	public function testInstance() {

		// mock da conexão mongo
		$mongo = $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
		->disableOriginalConstructor()
		->getMock();

		$a = new a($mongo);
		$this->assertInstanceOf(self::CLASSNAME, $a);

	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testGetAccessInvalidToken() {

		$this->instance->getAccess(null);

	}

	public function testGetAccessWithStringValue() {

		$this->instance->getAccess('126438');

	}

	public function testGetAccessNotFoundMustReturnNull() {

		$r = $this->instance->getAccess('126438');
		$this->assertNull($r);

	}

	public function testFlushTokenString() {

		$r = $this->instance->flushToken('Basic 1232131');
		$this->assertEquals('1232131', $r);

		$r = $this->instance->flushToken('Bearer 1232131');
		$this->assertEquals('1232131', $r);

		$r = $this->instance->flushToken('ASGAWS564ASW');
		$this->assertEquals('ASGAWS564ASW', $r);

	}


}