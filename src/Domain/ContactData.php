<?php

namespace Domain;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\EmbeddedDocument */
class ContactData {

  /**
   * @ODM\Collection
   */
  private $phones;

  /**
   * @ODM\String
   */
  private $email;

  /**
   * @ODM\String
   */
  private $facebook;

  /**
   * @ODM\String
   */
  private $site;

  public function __construct() {
    if($this->phones == null)
      $this->phones = [];
  }

  public function setPhones(array $phones) {
    $this->phones = $phones;
  }
  public function addPhone($phone) {
    if(!is_string($phone))
      throw new \InvalidArgumentException('Invalid phone');

    $phone = trim($phone);

    if(empty($phone))
      return;

    $this->phones[] = $phone;

  }
  public function getPhones() {
    return $this->phones;
  }

  public function setEmail($email) {
    if(!is_string($email))
      throw new \InvalidArgumentException('Invalid phone');

    if(empty($email)) {
      return;
    }

    $this->email = trim($email);

  }
  public function getEmail() {
    return $this->email;
  }

  public function setSite($site) {

    if(!is_string($site))
      throw new \InvalidArgumentException('Invalid phone');

    if(empty($site)) {
      return;
    }

    $this->site = trim($site);

  }

  public function getSite($site) {

    return $this->site;

  }

  public function setFacebook($facebook) {

    if(!is_string($facebook))
      throw new \InvalidArgumentException('Invalid facebook');

    if(empty($facebook)) {
      return;
    }

    $this->facebook = $facebook;

  }

  public function getFacebook() {

    return $this->facebook;

  }

  static public function create(array $data) {

    $is = false;

    $contact = new self;

    if(isset($data['email'])) {
      $contact->setEmail($data['email']);
      $is = true;
    }
    if(isset($data['phones'])) {
      $contact->setPhones($data['phones']);
      $is = true;
    }
    if(isset($data['email'])) {
      $contact->setEmail($data['email']);
      $is = true;
    }
    if(isset($data['site'])) {
      $contact->setSite($data['site']);
      $is = true;
    }
    if(isset($data['facebook'])) {
      $contact->setFacebook($data['facebook']);
      $is = true;
    }

    if($is == false) {
      return null;
    }

    return $contact;

  }

}
