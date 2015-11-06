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

  public function insert(array $data) {

    $mongo = $this->app['mongo.dm'];

    // Salva um service

    $place = new Place("Casa de cultura Mário Quintana", "STATUS", new Position(51.20098, -24.34874));
    $mongo->persist($place);
    $mongo->flush();

  }

  /**
   * Retorna todos
   * @return array
   */
  public function findAll() {

    $dm = $this->app['mongo.dm'];

    $document = $dm->getRepository('Domain\Place')->findAll();

    $dm->getHydratorFactory($document);

    var_dump($document);
    die;

  }

}
