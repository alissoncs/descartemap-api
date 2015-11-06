<?php

namespace Service;

use Silex\Application;
use Domain\Place;
use Domain\Position;

class PlaceService {

  private $app;

  public function __construct(Application $app) {

    $this->app =& $app;

  }

  /**
   * Retorna todos
   * @return array
   */
  public function findAll() {

    $mongo = $this->app['mongo.dm'];

    // Salva um service
    //
    $place = new Place("sample", "sample", new Position(51.31884, -24.34874));

    $mongo->persist($place);
    $mongo->flush();

    return ['sample' => 1];


  }

}
