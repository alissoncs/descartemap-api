<?php

namespace Service;

use Silex\Application;
use Domain\Place;
use Domain\Position;
use Exception\ValidationException;

class PlaceService {

  private $app;

  private $rules = null;

  public function __construct(Application $app) {

    $this->app =& $app;

  }

  /**
   * Criação de um recurso
   */
  public function insert($data) {

    $mongo = $this->app['mongo.dm'];

    $rules = array(
        'email' => 'required|max:200'
    );

    $validator = $this->app['validator'];

    $validator->add('name', 'required | maxlength(250)');

    $validator->add('position[latitude]', 'required | number');
    $validator->add('position[longitude]', 'required | number');

    $validator->add('contact[phones][*]', 'regex(/^[\(\d{2}\) \d+\-\d+$/)');

    $validator->add('contact[email]', 'email');
    $validator->add('address[street]', 'required');
    $validator->add('address[city]', 'required');
    $validator->add('address[state]', 'regex(/^\w{2}$/)');
    $validator->add('address[country]', 'required');
    $validator->add('address[number]', 'number');
    $validator->add('address[neighborhood]', 'required');
    $validator->add('address[zipcode]', 'regex(/^[0-9 \-]+$/)');
    $validator->add('active', 'match', [0,1]);

    if(!$validator->validate($data)) {
      throw new ValidationException($validator);
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

    $mongo = $this->app['mongo.dm'];

    $validator = $this->app['validator']->validateValue($data, $this->rules);

    if(count($validator) > 0) {
      throw new ValidationException($validator);
    }

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
