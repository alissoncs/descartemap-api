<?php 

use Silex\Application as Silex;

use Doctrine\ODM\MongoDB\Configuration;

abstract class BaseTest extends \PHPUnit_Framework_TestCase {

	private $app = null;

	// Cria uma aplicação silex limpa
	protected function createEmptyApp() {

		return new Silex;

	}

	// Doctrine DocumentManager mock
	protected function createDM(array $methods = array()) {
		
		return $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
		->disableOriginalConstructor()
		->setMethods($methods)
		->getMock();

	}

}