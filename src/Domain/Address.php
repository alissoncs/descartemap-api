<?php

namespace Domain;

class Address {

  private $street;

  private $number;

  private $city;

  private $state;

  private $country;

  private $zipcode;

  public function __construct($street = null, $number = null, $city = null, $state = null) {

    $this->setStreet($street);
    $this->setNumber($number);
    $this->setCity($city);
    $this->setState($state);

  }

  public function setStreet($street) {
    if(!is_string($street))
      throw new \InvalidArgumentException('Invalid');

    $this->street = $street;
  }
  public function getStreet() {
    return $this->street;
  }
  public function setNumber($number) {
    if(!is_string($number))
      throw new \InvalidArgumentException('Invalid');

    $this->number = $number;
  }
  public function getNumber() {
    return $this->number;
  }
  public function setCity($city) {
    if(!is_string($city))
      throw new \InvalidArgumentException('Invalid');

    $this->city = $city;
  }
  public function getCity() {
    return $this->city;
  }
  public function setState($state) {
    if(!is_string($state))
      throw new \InvalidArgumentException('Invalid');

    $this->state = $state;
  }
  public function getState() {
    return $this->state;
  }
  public function setCountry($country) {
    if(!is_string($country))
      throw new \InvalidArgumentException('Invalid');

    $this->country = $country;
  }
  public function getCountry() {
    return $this->country;
  }
  public function setZipcode($zipcode) {
    if(!is_string($zipcode))
      throw new \InvalidArgumentException('Invalid');

    $this->zipcode = $zipcode;
  }
  public function getZipcode() {
    return $this->zipcode;
  }

}
