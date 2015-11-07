<?php

namespace Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use InvalidArgumentException as Invalid;
use LogicException;

use Domain\Position;
use Domain\Address;
use Domain\ContactData;


/**
 * @ODM\Document(collection="places")
 */
class Place {

  /**
   * @ODM\Id
   */
  private $id;

  /**
   * @ODM\String
   */
  private $name;

  /**
   * @ODM\EmbedOne(targetDocument="Position")
   */
  private $position;

  /**
   * @ODM\EmbedOne(targetDocument="Address")
   */
  private $address;

  /**
   * @ODM\EmbedOne(targetDocument="ContactData")
   */
  private $contact;

  /**
   * @ODM\String
   */
  private $type;

  public function __construct($name = null, $type = null, Position $position = null) {

    if($name !== null)
      $this->setName($name);

    if($type !== null)
      $this->setType($type);

    if($position instanceof Position)
      $this->setPosition($position);

  }

  public function getId() {

    return $this->id;

  }

  public function setId($id) {

    $this->id = $id;

  }

  public function setName($name) {

    if(!is_string($name)) {
      throw new Invalid('Name must be int');
    }

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

  public function setType($type) {

    if(!is_string($type)) {
      throw new Invalid('Type must be int');
    }

    $this->type = $type;

  }

  public function getType() {

    return $this->type;

  }

  public function setContact(ContactData $contact) {

    $this->contact = $contact;

  }

  public function getContact() {

    return $this->contact;

  }

  static public function create(array $data, $place = null) {

    if($place == null) {
      $place = new self;
    }

    $place->setName($data['name']);
    $place->setType($data['type']);

    $position = new Position($data['latitude'], $data['longitude']);
    $place->setPosition($position);

    $place->setAddress(Address::create($data));

    $contact = ContactData::create($data);
    if($contact !== null)
      $place->setContact($contact);

    return $place;

  }

}
