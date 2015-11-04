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

    $db = $this->app['mongo.db'];
    
    $collection = new \MongoCollection($db, 'users');
    $cursor = $collection->find();

    return iterator_to_array($cursor);

    foreach ($cursor as $doc) {
      var_dump($doc);
    }

    die;

    return ['array' => 'data'];

  }

}
