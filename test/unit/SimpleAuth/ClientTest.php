<?php 

use SimpleAuth\Client as c;

class SimpleAuth_ClientTest extends BaseTest {

	/**
	 */
	public function testInstance() {

		$this->assertInstanceOf('SimpleAuth\Client', new c);

	}

}