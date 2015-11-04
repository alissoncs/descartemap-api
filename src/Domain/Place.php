<?php 

namespace Domain;

use Domain\Location;

class Place {

  private $name;

  private $location;

  public function setLocation(PositiLocationon $location) {

    $this->location = $location;

  }

  public function getLocation() {

    return $this->location;

  }

}