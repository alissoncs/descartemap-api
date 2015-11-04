<?php 

use Domain\Place;
use Domain\Position;

class PlaceTest extends \PHPUnit_Framework_TestCase {

  public function setUp() {

    $this->instance = new Place('Casa no Campo', 'COOK_OIL', new Position());

  }

  public function testInstance() {

    $this->assertInstanceOf('Domain\Place', $this->instance);

  }

  public function testNameAttribute() {

    $this->instance->setName('Alisson');

    $this->assertEquals('Alisson', $this->instance->getName());

  }

  public function testPositionAttribute() {

    $position = new Position();
    $this->instance->setPosition($position);
    $this->assertEquals($position, $this->instance->getPosition());

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
