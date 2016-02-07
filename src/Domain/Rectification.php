<?php

namespace Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\EmbeddedDocument */
class Rectification {

  /**
   * @ODM\Int
   */
  private $notExists = 0;

  /**
   * @ODM\Int
   */
  private $wrongAddress = 0;

  /**
   * @ODM\Int
   */
  private $wrongPhone = 0;

  /**
   * @ODM\Int
   */
  private $wrongAcceptance = 0;

  public function __construct(array $data = array()) {
    
    $this->assign($data);

  }

  public function assign(array $data = array()) {

    if(isset($data['not_exists']) && $data['not_exists'] == '1') {
      $this->setNotExists();
    }
    if(isset($data['wrong_address']) && $data['wrong_address'] == '1') {
      $this->setWrongAddress();
    }
    if(isset($data['wrong_phone']) && $data['wrong_phone'] == '1') {
      $this->setWrongPhone();
    }
    if(isset($data['wrong_acceptance']) && $data['wrong_acceptance'] == '1') {
      $this->setWrongAcceptance();
    }

  }
  public function getNotExists($n) {
    return $this->notExists;
  }

  public function getWrongAddress($n) {
    return $this->wrongAddress;
  }

  public function getWrongPhone($n) {
    return $this->wrongPhone;
  }

  public function getWrongAcceptance($n) {
    return $this->wrongAcceptance;
  }

  public function setNotExists($n = null) {
    if(is_int($n)) {
      $this->notExists = $n;
    } else {
      $this->notExists++;
    }
  }

  public function setWrongAddress($n = null) {
    if(is_int($n)) {
      $this->wrongAddress = $n;
    } else {
      $this->wrongAddress++;
    }
  }

  public function setWrongPhone($n = null) {
    if(is_int($n)) {
      $this->wrongPhone = $n;
    } else {
      $this->wrongPhone++;
    }
  }

  public function setWrongAcceptance($n = null) {
    if(is_int($n)) {
      $this->wrongAcceptance = $n;
    } else {
      $this->wrongAcceptance++;
    }
  }

}
