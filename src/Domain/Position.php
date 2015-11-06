<?php

namespace Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\EmbeddedDocument */
class Position {

  /**
   * @ODM\Float
   */
  private $latitude;

  /**
   * @ODM\Float
   */
  private $longitude;

  public function __construct($lat, $lng) {

      $this->setLatitude($lat);
      $this->setLongitude($lng);

  }

  public function getLatitude() {

    return $this->latitude;

  }

  public function getLongitude() {

    return $this->longitude;

  }

  public function setLatitude($latitude) {

    $this->latitude = $latitude;

  }

  public function setLongitude($longitude) {

    $this->longitude = $longitude;

  }

}
