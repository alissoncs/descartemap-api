<?php 
namespace FuncTest;

use GuzzleHttp\Client;

abstract class BaseTest extends \PHPUnit_Framework_TestCase {

  private $httpClient = null;

  public function setUp() {

  	parent::setUp();

  	if(!defined('BASE_URL')) {
  		die("Constant BASE_URL not defined");
  	}

  }

  protected function client() {

  	//$url = rtrim(BASE_URL, '/');
    if($this->httpClient == null) {
      $url = BASE_URL;
      $this->httpClient = new Client([
      	'http_errors' => false,
      	'base_uri' => $url,
        'headers' => [
          'Authorization' => AUTHORIZATION
        ]
      ]);
    }

    return $this->httpClient;

  }

  public function checkJson($response) {

  	// $this->assertRegExp('/application\/json/', $response->getHeader('Content-type'));

  }

}
