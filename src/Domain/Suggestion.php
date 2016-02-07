<?php

namespace Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use Domain\Position;

/**
 * @ODM\Document(collection="suggestions")
 */
class Suggestion {

  public function __construct() {

  }

  static public function create(array $data) {

  		$e = new self();

    return $e;

  }

}
