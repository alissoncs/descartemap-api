<?php

namespace Service;

use Silex\Application;

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

    return ['sample' => 1];


  }

}
