<?php

namespace Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use InvalidArgumentException as Invalid;
use Domain\Position;
use Domain\Address;

/**
 * @Document(collection="places")
 */
class Place {

  /**
   * @ODM\Id
   */
  private $id;

  /**
   * @ODM\String
   */
  private $name;

  private $position;

  private $address;

  private $type;

  public function __construct($name, $type, Position $position) {

    $this->setName($name);
    $this->setType($type);
    $this->setPosition($position);

  }

  public function setName($name) {

    if(!is_string($name)) {
      throw new Invalid('Name must be int');
    }

    $this->name = $name;

  }

  public function getName() {

    return $this->name;

  }

  public function setPosition(Position $position) {

    $this->position = $position;

  }

  public function getPosition() {

    return $this->position;

  }

  public function setAddress(Address $address) {

    $this->address = $address;

  }

  public function getAddress() {

    return $this->address;

  }

  public function setType($type) {

    if(!is_string($type)) {
      throw new Invalid('Type must be int');
    }

    $this->type = $type;

  }

  public function getType() {

    return $this->type;

  }

}
