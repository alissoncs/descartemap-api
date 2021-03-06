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
   * @ODM\EmbedOne(targetDocument="Rectification")
   */
  private $rectification;

  /**
   * @ODM\String
   */
  private $type;

  /**
   * @ODM\Boolean
   */
  private $active = true;

  /**
   * @ODM\Boolean(name="can_buy")
   */
  private $canBuy = false;

  /**
   * @ODM\Int(name="thumbs_up")
   */
  private $thumbsUp = 0;

  /**
   * @ODM\Int(name="thumbs_down")
   */
  private $thumbsDown = 0;

  /**
   * @ODM\Collection
   */
  private $materials = [];

  /**
   * @ODM\Date
   */
  private $date;


  public function __construct($name = null, $type = null, Position $position = null) {

    if($name !== null)
      $this->setName($name);

    if($type !== null)
      $this->setType($type);

    if($position instanceof Position)
      $this->setPosition($position);

    $this->materials = [];

  }

  public function getId() {

    return $this->id;

  }

  public function setId($id) {

    $this->id = $id;

  }

  public function setName($name) {

    if(!is_string($name)) {
      throw new Invalid('Name must be string');
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

  public function setActive($active) {

    if(is_string($active)) {

        if($active == 'true')
          $active = true;
        else if($active == 'false')
          $active = false;

    }

    $this->active = (bool) $active;

  }

  public function isActive() {

    return $this->active;

  }

  public function setCanBuy($canBuy) {

    if(is_string($canBuy)) {

        if($canBuy == 'true')
          $canBuy = true;
        else if($canBuy == 'false')
          $canBuy = false;

    }

    $this->canBuy = (bool) $canBuy;

  }

  public function isCanBuy() {

    return $this->canBuy;

  }

  public function setThumbsUp($thumbsUp) {
    $this->thumbsUp = $thumbsUp;
  }
  public function setThumbsDown($thumbsDown) {
    $this->thumbsDown = $thumbsDown;
  }
  public function getThumbsUp() {
    return $this->thumbsUp;
  }
  public function getThumbsDown() {
    return $this->thumbsDown; 
  }

  public function setRectification(Rectification $rectification) {
    
    $this->rectification = $rectification;

  }
  
  public function getRectification() {

    return $this->rectification;

  }

  static public function create(array $data, $place = null) {

    if($place == null) {
      $place = new self;
    }

    if(isset($data['name']))
      $place->setName($data['name']);

    if(isset($data['type']))
    $place->setType($data['type']);

    if(isset($data['active']))
      $place->setActive($data['active']);

    if(isset($data['can_buy']))
      $place->setCanBuy($data['can_buy']);

    if(isset($data['position']) && isset($data['position']['latitude']) && isset($data['position']['longitude'])) {
      $position = new Position($data['position']['latitude'], $data['position']['longitude']);
      $place->setPosition($position);
    }

    if(isset($data['address']))
      $place->setAddress(Address::create($data['address']));

    if(isset($data['contact'])) {
      $contact = ContactData::create($data['contact']);
      if($contact !== null)
        $place->setContact($contact);
    }

    if(isset($data['materials'])) {
      $place->materials = $data['materials'];
    }

    $place->date = new \DateTime();

    return $place;

  }

}
