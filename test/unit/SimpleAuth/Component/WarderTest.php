<?php 

use SimpleAuth\Component\Warder as w;

class WarderTest extends BaseTest {

	public function setUp() {
		parent::setUp();
		$this->instance = new w();
	}

	public function testInstance() {
		$this->assertInstanceOf('SimpleAuth\Component\Warder', $this->instance);
	}

}