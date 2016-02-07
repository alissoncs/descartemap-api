<?php

namespace Service;

use Silex\Application;
use Domain\Place;
use Domain\Position;
use Domain\Rectification;
use Exception\ValidationException;

class PlaceService {

  private $app;

  private $v = null;

  public function __construct(Application $app) {

    $this->app =& $app;

    $this->v = $this->app['validator'];
    $this->v->add('name', 'required | maxlength(250)');
    $this->v->add('type', 'required');
    $this->v->add('type', 'inlist', ['list' => [
      'ALL', 'HOSPITAL', 'COOK_OIL', 'ELETRONIC', 'BATTERY', 'RECYCLING', 'OTHER'
      ]
    ]);
    $this->v->add('position[latitude]', 'required | number');
    $this->v->add('position[longitude]', 'required | number');
    $this->v->add('contact[phones][*]', 'regex', ['pattern' => '/^\(\d{2}\) ?\d+\-\d+$/']);
    $this->v->add('contact[email]', 'email');
    $this->v->add('address[street]', 'required');
    $this->v->add('address[city]', 'required');
    $this->v->add('address[state]', 'required | regex(/^\w{2}$/)');
    $this->v->add('address[country]', 'required');
    $this->v->add('address[number]', 'required | number | regex(/^\d+$/)');
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

    return $place;

  }

  /**
   * Retorna todos
   * @return array
   */
  public function findAll(array $options = array(), $resultArray = false) {

    $qb = $this->app['mongo.dm']
    ->createQueryBuilder('Domain\Place');

    if(isset($options['fields'])) {
      $qb->select(explode(',', $options['fields']));
    }

    if(isset($options['limit']) && is_numeric($options['limit'])) {
      $qb->limit((int)$options['limit']);
    }

    if(isset($options['type'])) {
      $qb->field('type')->in(explode(',', $options['type']));
    }

    $qb->field('active')->equals(true);

    $qb->limit(500);

    $data = $qb->hydrate(!$resultArray)
    ->getQuery()
    ->execute();

    if($resultArray == true) {
      return $data->toArray(false);
    }

    return $data;

  }

  public function findOne($id, $resultArray = false) {

    $place = $this->app['mongo.dm']
    ->createQueryBuilder('Domain\Place')
    ->field('_id')->equals($id)
    ->hydrate(!$resultArray)
    ->getQuery()->getSingleResult();

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

  public function avaliate($id, $type = '1') {

    // Retorna Item
    $place = $this->findOne($id);
    if($place == null) {
      throw new \Exception\NotFoundException();
    }

    // Pega o tipo
    $type = (int) $type;
    $type = ($type !== 1 ? 0 : 1);

    // Caso tipo seja 1, incrementa
    if($type === 1) {
      $place->setThumbsUp($place->getThumbsUp() + 1);
    } else {
      $place->setThumbsDown($place->getThumbsDown() + 1);
    }

    // Salva
    $mongo = $this->app['mongo.dm'];
    $mongo->persist($place);
    $mongo->flush();

  }

  public function pushRectification($placeId, array $data) {

    $place = $this->findOne($placeId);

    $rectification = $place->getRectification(); 
    if($rectification == null) {
      $rectification = new Rectification($data);
    } else {
      $rectification->assign($data);
    }

    $place->setRectification($rectification);

    $mongo = $this->app['mongo.dm'];
    $mongo->persist($place);
    $mongo->flush();

  }

  public function cities() {

    $cities = $this->app['mongo.dm']
    ->createQueryBuilder('Domain\Place')
    ->select('address.city')
    ->distinct('address.city')
    ->hydrate(false)
    ->getQuery()->execute()->toArray();

    return $cities;

  }

}
