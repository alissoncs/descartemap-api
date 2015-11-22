<?php 

use SimpleAuth\Component\Authenticator as a;
use SimpleAuth\AccessToken;
use SimpleAuth\Client;

use Mockery as m; // Mocks

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

		$a = $this->instance;

		$this->assertInstanceOf(self::CLASSNAME, $a);

	}

	public function testPerfectWayShouldReturnAObject() {

		$accessReturnMock = new AccessToken();
		$accessReturnMock->setToken('21312312');

		$qbMock = $this->getMockBuilder('Doctrine\ODM\MongoDB\QueryBuilder')
		->disableOriginalConstructor()
		->setMethods(['field', 'equals', 'getQuery', 'getSingleResult'])
		->getMock();

		$qbMock->method('field')->will($this->returnSelf());
		$qbMock->method('equals')->will($this->returnSelf());
		$qbMock->method('getQuery')->will($this->returnSelf());
		$qbMock->method('getSingleResult')->will($this->returnValue($accessReturnMock));

		$mongoMock = $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
		->disableOriginalConstructor()
		->setMethods(['createQueryBuilder'])
		->getMock();

		$mongoMock->expects($this->once())
		->method('createQueryBuilder')
		->will($this->returnValue($qbMock));

		$this->instance = new a($mongoMock);
		$object = $this->instance->getAccess('u123978');

		$this->assertEquals('21312312', $accessReturnMock->getToken());

	}

	public function testGetAccessWithNullResultMustReturnNull() {

		$qbMock = $this->getMockBuilder('Doctrine\ODM\MongoDB\QueryBuilder')
		->disableOriginalConstructor()
		->setMethods(['field', 'equals', 'getQuery', 'getSingleResult'])
		->getMock();

		$qbMock->method('field')->will($this->returnSelf());
		$qbMock->method('equals')->will($this->returnSelf());
		$qbMock->method('getQuery')->will($this->returnSelf());
		$qbMock->method('getSingleResult')->will($this->returnValue(null));

		$mongoMock = $this->createDM();

		$mongoMock->expects($this->once())
		->method('createQueryBuilder')
		->will($this->returnValue($qbMock));

		// Chamada
		$this->instance = new a($mongoMock);

		$object = $this->instance->getAccess('u123978');

		$this->assertNull($object);

	}

	public function testGetAccessInvalidToken() {

		$null = $this->instance->getAccess(null);
		$this->assertNull($null);

		$null = $this->instance->getAccess("");
		$this->assertNull($null);

	}


	public function testFlushTokenString() {

		$r = $this->instance->flushToken('Basic 1232131');
		$this->assertEquals('1232131', $r);

		$r = $this->instance->flushToken('Bearer 1232131');
		$this->assertEquals('1232131', $r);

		$r = $this->instance->flushToken('ASGAWS564ASW');
		$this->assertEquals('ASGAWS564ASW', $r);

		$r = $this->instance->flushToken('ASGAWS564ASW   ');
		$this->assertEquals('ASGAWS564ASW', $r);

	}


}