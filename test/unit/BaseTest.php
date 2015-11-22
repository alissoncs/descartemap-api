<?php 

use Silex\Application as Silex;

abstract class BaseTest extends \PHPUnit_Framework_TestCase {

	private $app = null;

	// Cria aplicação Silex para testes
	public function createApp() {

		if(null == $this->app) {
			// $this->app = require ROOT . 'src/app.php';
		}

	}

	// Cria uma aplicação silex limpa
	public function createEmptyApp() {

		return new Silex;

	}

}