<?php 

use Service\PlaceService;

class PlaceServiceTest extends BaseTest {

	public function setUp() {

		parent::setUp();

	}

	public function testInstance() {

		$app = $this->getAppMock();
		$service = new PlaceService($app);
		$this->assertInstanceOf('Service\PlaceService', $service);

	}

	public function testValidatorMustDefineRules13Times() {
		$app = $this->getAppMock();
		$app['validator']->expects($this->exactly(13))->method('add');
		$service = new PlaceService($app);
	}

	public function testFindAllMethod() {

		$qbMock = $this->getQueryBuilderMock();

		$app = $this->getAppMock();
		$app['mongo.dm'] = $this->getDmMock();
		$app['mongo.dm']->expects($this->once())
		->method('createQueryBuilder')
		->willReturn($qbMock);

		$service = new PlaceService($app);
		$service->findAll();

	}

}