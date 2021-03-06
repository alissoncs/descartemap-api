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

  public function __construct($lat = null, $lng = null) {

    if($lat !== null) {
      $lat = (float) $lat;
      $this->setLatitude($lat);
    }

    if($lng !== null) {
        $lng = (float) $lng;
        $this->setLongitude($lng);
    }
    
  }

  public function getLatitude() {

    return $this->latitude;

  }

  public function getLongitude() {

    return $this->longitude;

  }

  public function setLatitude($latitude) {

    if(!is_float($latitude)) {
      throw new \InvalidArgumentException('Invalid');
    }

    $this->latitude = $latitude;

  }

  public function setLongitude($longitude) {

    if(!is_float($longitude)) {
      throw new \InvalidArgumentException('Invalid');
    }

    $this->longitude = $longitude;

  }

}
