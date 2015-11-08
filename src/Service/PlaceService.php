<?php

namespace Service;

use Silex\Application;
use Domain\Place;
use Domain\Position;
use Exception\ValidationException;

class PlaceService {

  private $app;

  private $v = null;

  public function __construct(Application $app) {

    $this->app =& $app;

    $this->v = $this->app['validator'];
    $this->v->add('name', 'required | maxlength(250)');
    $this->v->add('type', 'inlist', ['list' => [
      'ALL', 'HOSPITAL', 'COOK_OIL', 'ELETRONIC', 'BATTERY', 'RECYCLING', 'OTHER'
      ]
    ]);
    $this->v->add('position[latitude]', 'required | number');
    $this->v->add('position[longitude]', 'required | number');
    $this->v->add('contact[phones][*]', 'regex(/^[\(\d{2}\) \d+\-\d+$/)');
    $this->v->add('contact[email]', 'email');
    $this->v->add('address[street]', 'required');
    $this->v->add('address[city]', 'required');
    $this->v->add('address[state]', 'regex(/^\w{2}$/)');
    $this->v->add('address[country]', 'required');
    $this->v->add('address[number]', 'number');
    $this->v->add('address[neighborhood]', 'required');
    $this->v->add('address[zipcode]', 'regex', ['pattern'=>'/^(\d+\-?\d+|)$/']);

  }

  /**
   * Criação de um recurso
   */
  public function insert($data) {

    $mongo = $this->app['mongo.dm'];

    if(!$this->v->validate($data)) {
      throw new ValidationException($this->v);
    }

    $place = Place::create($data);

    $mongo->persist($place);
    $mongo->flush();

    return true;

  }

  public function findOne($id) {

    $place = $this->app['mongo.dm']->getRepository('Domain\Place')->find($id);

    if($place == null) {
      throw new \Exception\NotFoundException();
    }

    return $place;

  }

  /**
   * Exclui um item pelo id
   * @param int $id
   * @return bool
   */
  public function delete($id) {

    $place = $this->findOne($id);

    $this->app['mongo.dm']->remove($place);
    $this->app['mongo.dm']->flush();

    return true;

  }

  public function update($id, $data) {

    $current = $this->findOne($id);

    if(!$this->v->validate($data)) {
      throw new ValidationException($this->v);
    }

    $mongo = $this->app['mongo.dm'];
    $mongo->persist(Place::create($data, $current));
    $mongo->flush();

  }

  /**
   * Retorna todos
   * @return array
   */
  public function findAll(array $options = array()) {

    $data = $this->app['mongo.dm']->getRepository('Domain\Place')->findAll();

    return $data;

  }

}
