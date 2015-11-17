<?php

namespace Domain;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\EmbeddedDocument */
class Address {

  /**
   * @ODM\String
   */
  private $street;

  /**
   * @ODM\Int
   */
  private $number;

  /**
   * @ODM\String
   */
  private $neighborhood;

  /**
   * @ODM\String
   */
  private $city;

  /**
   * @ODM\String
   */
  private $state;

  /**
   * @ODM\String
   */
  private $country;

  /**
   * @ODM\String
   */
  private $zipcode;

  public function __construct($street = null, $number = null, $neighborhood = null, $city = null, $state = null) {

    if(!is_null($street))
      $this->setStreet($street);

    if(!is_null($number))
      $this->setNumber($number);

    if(!is_null($neighborhood))
      $this->setNeighborhood($neighborhood);

    if(!is_null($city))
      $this->setCity($city);

    if(!is_null($state))
      $this->setState($state);

  }

  public function setStreet($street) {
    if(!is_string($street))
      throw new \InvalidArgumentException('Invalid street');

    $street = ucwords($street);

    $this->street = $street;
  }
  public function getStreet() {
    return $this->street;
  }
  public function setNumber($number) {
    if(!is_int($number))
      throw new \InvalidArgumentException('Invalid number');

    $this->number = $number;
  }
  public function getNumber() {
    return $this->number;
  }
  public function setNeighborhood($neighborhood) {
    if(!is_string($neighborhood))
      throw new \InvalidArgumentException('Invalid neighborhood');

    $this->neighborhood = $neighborhood;
  }
  public function getNeighborhood() {
    return $this->neighborhood;
  }
  public function setCity($city) {
    if(!is_string($city))
      throw new \InvalidArgumentException('Invalid city');

    $this->city = $city;
  }
  public function getCity() {
    return $this->city;
  }
  public function setState($state) {
    if(!is_string($state))
      throw new \InvalidArgumentException('Invalid state');

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

  static public function create(array $data) {

    $add = new self;
    
    if(isset($data['street']))
      $add->setStreet($data['street']);

    if(isset($data['city']))
      $add->setCity($data['city']);

    if(isset($data['state']))
      $add->setState($data['state']);

    if(isset($data['country']))
      $add->setCountry($data['country']);

    if(isset($data['neighborhood']))
      $add->setNeighborhood($data['neighborhood']);

    if(isset($data['number'])) {
      $add->setNumber((int)$data['number']);
    }

    if(isset($data['zipcode'])) {
      $add->setZipcode($data['zipcode']);
    }

    return $add;

  }

}
