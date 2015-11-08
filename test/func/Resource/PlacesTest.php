<?php

use FuncTest\BaseTest;

class PlacesTest extends BaseTest {

	public function testGetAll() {

		$response = $this->client()->get('/places');

		$this->assertEquals(200, $response->getStatusCode());

	}

}