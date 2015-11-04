<?php 

namespace Domain;

use Domain\Position;
use Domain\Address;

class Place {

  private $name;

  private $position;

  private $address;

  public function __construct(Position $position) {

    $this->setPosition($position);

  }

  public function setName($name) {

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

}