<?php

namespace Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\EmbeddedDocument */
class Rectification {

  /**
   * @ODM\Int(name="not_exists")
   */
  private $notExists = 0;

  /**
   * @ODM\Int(name="wrong_address")
   */
  private $wrongAddress = 0;

  /**
   * @ODM\Int(name="wrong_phone")
   */
  private $wrongPhone = 0;

  /**
   * @ODM\Int(name="wrong_acceptance")
   */
  private $wrongAcceptance = 0;

  public function __construct(array $data = array()) {
    
    $this->assign($data);

  }

  public function assign(array $data = array()) {

    if(isset($data['not_exists']) && ((bool)$data['not_exists']) == true) {
      $this->setNotExists();
    }
    if(isset($data['wrong_address']) && ((bool)$data['wrong_address']) == true) {
      $this->setWrongAddress();
    }
    if(isset($data['wrong_phone']) && ((bool)$data['wrong_phone']) == true) {
      $this->setWrongPhone();
    }
    if(isset($data['wrong_acceptance']) && ((bool)$data['wrong_acceptance']) == true) {
      $this->setWrongAcceptance();
    }

  }
  public function getNotExists() {
    return $this->notExists;
  }

  public function getWrongAddress() {
    return $this->wrongAddress;
  }

  public function getWrongPhone() {
    return $this->wrongPhone;
  }

  public function getWrongAcceptance() {
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
