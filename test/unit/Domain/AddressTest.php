<?php 

use Domain\Address;

class AddressTest extends BaseTest {

	public function setUp() {

		parent::setUp();

	}

	public function testInstanceType() {

		$add = new Address();
		$this->assertInstanceOf('Domain\Address', $add);

	}

}