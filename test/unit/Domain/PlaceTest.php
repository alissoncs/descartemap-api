<?php

use Domain\Place;
use Domain\Position;

class PlaceTest extends \PHPUnit_Framework_TestCase {

  public function setUp() {

    $this->instance = new Place('Casa no Campo', 'COOK_OIL', new Position(23.48,54.548));

  }

  public function testInstance() {

    $this->assertInstanceOf('Domain\Place', $this->instance);

  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testInvalidName() {

    $this->instance->setName(13);

  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testInvalidType() {

    $this->instance->setType(true);

  }

}
