<?php 

use SimpleAuth\Silex\Provider as p;

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

}