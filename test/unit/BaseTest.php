<?php 

use Silex\Application as Silex;

use Doctrine\ODM\MongoDB\Configuration;

abstract class BaseTest extends \PHPUnit_Framework_TestCase {

	private $app = null;

	// Cria uma aplicação silex limpa
	protected function createEmptyApp() {

		return $this->getMock('Silex\Application');

	}

	// cria um mock de Silex\Application
	protected function getAppMock() {

		$app = new Silex();
		$app['validator'] = $this->getValidatorMock();
		$app['mongo.dm'] = $this->getDmMock();
		return $app;

	}

	protected function getValidatorMock() {

		return $this->getMockBuilder('Sirius\Validation\Validator')->disableOriginalConstructor()->getMock();

	}

	// Doctrine DocumentManager mock
	protected function getDmMock(array $methods = array()) {
		
		return $this->getMockBuilder('Doctrine\ODM\MongoDB\DocumentManager')
		->disableOriginalConstructor()
		->setMethods($methods)
		->getMock();

	}

	public function getMock($originalClassName, 
		$methods = array(), 
		array $arguments = array(), 
		$mockClassName = '', 
		$callOriginalConstructor = true, 
		$callOriginalClone = true, 
		$callAutoload = true, 
		$cloneArguments = false, 
		$callOriginalMethods = false) {

		$callOriginalConstructor	= false;

		return parent::getMock(
			$originalClassName, 
			$methods, 
			$arguments, 
			$mockClassName, 
			$callOriginalConstructor, 
			$callOriginalClone, 
			$callAutoload, 
			$cloneArguments
		);

	}

	public function getQueryBuilderMock(array $methods = null) {

		$methods = array('field', 'hydrate', 'equals', 'getQuery', 'execute');

		$mock = $this->getMock('Doctrine\MongoDB\Query\Builder', $methods);
		$mock->expects($this->any())->method('field')->will($this->returnSelf());
		$mock->expects($this->any())->method('hydrate')->will($this->returnSelf());
		$mock->expects($this->any())->method('getQuery')->will($this->returnSelf());
		return $mock;

	}

}