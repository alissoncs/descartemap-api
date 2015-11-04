<?php 

use Domain\Place;
use Domain\Position;

class PlaceTest extends \PHPUnit_Framework_TestCase {

  public function setUp() {

    $this->instance = new Place(new Position());

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

}
