<?php 

use SimpleAuth\Grant as g;

class GrantTest extends BaseTest {

	public function setUp() {

		parent::setUp();

	}

	public function testIsValidNotValidMustReturnFalse() {

		$this->assertTrue(g::isValid(g::ALL));
		$this->assertTrue(g::isValid(g::LEVEL_1));
		$this->assertTrue(g::isValid(g::LEVEL_2));
		$this->assertTrue(g::isValid(g::LEVEL_3));
		$this->assertFalse(g::isValid(-1));
		$this->assertFalse(g::isValid(4));

	}

	/**
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionCode 1
	 */
	public function testNotIntegerValueMustThrowException() {

		g::isValid('asd');

	}

}