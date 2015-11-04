<?php 

use Domain\Place;
use Domain\Position;

class PositionTest extends \PHPUnit_Framework_TestCase {

  public function setUp() {

    $this->instance = new Position;

  }

  public function testInstance() {

    $this->assertInstanceOf('Domain\Position', $this->instance);

  }

  public function testLatitudeAttribute() {

    $this->instance->setLatitude(-54.34843548);

    $this->assertEquals(-54.34843548, $this->instance->getLatitude());

  }

  public function testLongitudeAttribute() {
    
    $this->instance->setLongitude(-54.34843548);

    $this->assertEquals(-54.34843548, $this->instance->getLongitude());

  }

}
