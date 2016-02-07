<?php

namespace Service;

use Silex\Application;
use Domain\Place;
use Exception\ValidationException;

class SuggestionService {

  private $app;

  private $v = null;

  public function __construct(Application $app) {

    $this->app =& $app;

    $this->v = $this->app['validator'];
    $this->v->add('name', 'required | maxlength(250)');
    $this->v->add('type', 'required');    

  }

  /**
   * Criação de um recurso
   */
  public function insert($data) {



  }

}
