<?php

namespace Service;

use Silex\Application;
use SimpleAuth\AccessToken;

class AuthService {

  private $app;

  private $tokenUrl = 'token';

  public function setTokenUrl($tokenUrl) {

    if(!is_string($tokenUrl)) {
      throw new \InvalidArgumentException('String required');
    }

    $this->tokenUrl = $tokenUrl;

  }

  public function getTokenUrl() {

    return $this->tokenUrl;

  }

  public function __construct(Application &$app) {

    $this->app =& $app;

  }

  /**
   * Verifica se usuário existe e pode acessar a API
   * @param  string  $token
   * @return boolean
   */
  public function isAllowed($token) {

    if($this->app['request']->getPathInfo() == '/'.$this->getTokenUrl()) {

      return true;

    }

    $dm = $this->app['mongo.dm'];

    $accessObject = $dm->getRepository('SimpleAuth\AccessToken')
    ->findOneBy(['token' => $token]);

    return $accessObject !== null;

  }

  /**
   * Retorna novo cliente de acesso
   * @return array|null
   */
  public function generate() {

    $dm = $this->app['mongo.dm'];

    $accessObject = new AccessToken();
    $accessObject->setToken(AccessToken::genToken());
    $accessObject->setRefreshToken(AccessToken::genToken());

    $dm->persist($accessObject);
    $dm->flush();

    return [
      'token' => $accessObject->getToken(),
      'refresh_token' => $accessObject->getRefreshToken()
    ];

  }


}
