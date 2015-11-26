<?php 

use SimpleAuth\Silex\Provider as p;
use SimpleAuth\Component\Warder as w;
use SimpleAuth\Component\Authenticator as a;

class ProviderTest extends BaseTest {

	public function setUp() {

		$this->instance = new p;

	}

	public function testRegisterMethodMustDebugAttribute() {

		$app = $this->createEmptyApp();
		$this->instance->register($app);

		$this->assertArrayHasKey(p::PREFIX . 'debug', $app);
		$this->assertEquals($app['debug'], $app[p::PREFIX . 'debug']);

	}

	public function testWarderAttribute() {

		$app = $this->createEmptyApp();
		$this->instance->register($app);

		$this->assertArrayHasKey(p::PREFIX . w::NAME, $app);
		$this->assertInstanceOf('SimpleAuth\Component\Warder', $app[p::PREFIX . w::NAME]);

	}

	public function testAuthorizatorAttribute() {

		$app = $this->createEmptyApp();
		$app['mongo.dm'] = $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
		->disableOriginalConstructor()
		->getMock();
		
		$this->instance->register($app);

		$this->assertArrayHasKey(p::PREFIX . w::NAME, $app);
		$this->assertInstanceOf('SimpleAuth\Component\Authenticator', $app[p::PREFIX . a::NAME]);

	}

}