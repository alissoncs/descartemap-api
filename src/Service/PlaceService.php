<?php

namespace Service;

use Silex\Application;
use Domain\Place;
use Domain\Position;

use Exception\ValidationException;

use Symfony\Component\Validator\Constraints as Assert;

class PlaceService {

  private $app;

  private $rules = null;

  public function __construct(Application $app) {

    $this->app =& $app;

    $this->rules = new Assert\Collection(array(
        'name' => new Assert\Length(array('min' => 2)),
        'type' => new Assert\Choice(['ALL', 'COOK_OIL', 'BATTERY', 'ELETRONIC', 'HOSPITAL']),
        'latitude' =>  [new Assert\NotBlank(), new Assert\Type(['type' => 'numeric'])],
        'longitude' =>  [new Assert\NotBlank(), new Assert\Type(['type' => 'numeric'])],
        'street' => new Assert\NotBlank(),
        'city' => [new Assert\Regex(['pattern' => '/^[a-zA-ZÁ-Úá-ú ]+$/']), new Assert\NotBlank()],
        'state' => [new Assert\Regex(['pattern' => '/^[A-Z]{2}$/']), new Assert\NotBlank()],
        'zipcode' => [new Assert\Regex(['pattern' => '/^[0-9\-]+$/'])],
        'email' => [new Assert\Email()],
        'phone' => [new Assert\Regex(['pattern' => '/^\(\d+\) [0-9\-]+$/'])],
        'phone' => [new Assert\Regex(['pattern' => '/^\(\d+\) [0-9\-]+$/'])],
        'active' => [new Assert\Choice(['1','0'])]
    ));

  }

  /**
   * Criação de um recurso
   */
  public function insert($data) {

    $mongo = $this->app['mongo.dm'];

    $validator = $this->app['validator']->validateValue($data, $this->rules);

    if(count($validator) > 0) {
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
    // $validator->allowMissingFields = true;

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
