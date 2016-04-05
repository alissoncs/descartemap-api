<?php

use Domain\Place;

class PlaceTest extends BaseTest {

	public function setUp() {

		parent::setUp();

	}

	public function testInstanceType() {

		$add = new Place();
		$this->assertInstanceOf('Domain\Plac/e', $add);

	}

	public function testConstructor() {

		$position = $this->getMock('Domain\Position');

		$place = new Place('House', 'DEFAULT_TYPE', $position);
		$this->assertSame($position, $place->getPosition());
		$this->assertEquals('House', $place->getName());
		$this->assertEquals('DEFAULT_TYPE', $place->getType());

	}

	public function testCreateStatic() {

		$place = Place::create(array(), null);
		$this->assertInstanceOf('Domain\Place', $place);

	}

	/**
	 * @depends testCreateStatic
	 */
	public function testCreateStaticWithPositionInstance() {

		$data = array(
			'position' => array(
				'latitude' => 10,
				'longitude' => 20
			)
		);

		$place = Place::create($data, null);

		$this->assertInstanceOf('Domain\Position', $place->getPosition());

	}

}
