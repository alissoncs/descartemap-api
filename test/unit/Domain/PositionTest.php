<?php

use Domain\Place;
use Domain\Position;

class PositionTest extends \PHPUnit_Framework_TestCase {

  public function setUp() {

    $this->instance = new Position(54.6748, 64.1987);

  }

  public function testInstance() {

    $this->assertInstanceOf('Domain\Position', $this->instance);

  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testInvalidLat() {

    $this->instance->setLatitude('teste');

  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testInvalidLng() {

    $this->instance->setLongitude('teste');

  }

}
