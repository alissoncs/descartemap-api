<?php 

namespace Domain;

class Position {

  private $latitude;

  private $longitude;

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