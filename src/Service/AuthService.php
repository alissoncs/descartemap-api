<?php

namespace Service;

use Silex\Application;
use SimpleAuth\Client;

class AuthService {

  private $app;

  public function __construct(Application &$app) {

    $this->app =& $app;

  }

  /**
   * Verifica se usuário existe e pode acessar a API
   * @param  string  $token
   * @return boolean
   */
  public function isAllowed($token) {

    $dm = $this->app['mongo.dm'];

    $client = $dm->getRepository('SimpleAuth\Client')
    ->findOneBy(['token' => $token]);

    return $client !== null;

  }

  /**
   * Retorna novo cliente de acesso
   * @return array|null
   */
  public function generate() {

    $dm = $this->app['mongo.dm'];

    $client = new Client();
    $client->setToken(Client::genToken());
    $client->setRefreshToken(Client::genToken());

    $dm->persist($client);
    $dm->flush();

    return [
      'token' => $client->getToken(),
      'refresh_token' => $client->getRefreshToken()
    ];

  }


}
