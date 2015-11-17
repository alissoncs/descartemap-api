<?php

use FuncTest\BaseTest;

class PlacesTest extends BaseTest {

	public function testGetAll() {

		$res = $this->client()->get('/api/places');

		$this->assertEquals(200, $res->getStatusCode());

		$this->checkJson($res);

	}

	public function testInvalidInserting() {

		$body = [
		];
		$res = $this->client()->post('/api/places',['body' => json_encode($body)]);
		$data = json_decode($res->getBody(), true);

		// erros de validação
		$this->assertEquals(422, $res->getStatusCode());
		$this->assertArrayHasKey('validation_error', $data);
		$this->assertArrayHasKey('name', $data['validation_error']);
		$this->assertArrayHasKey('type', $data['validation_error']);
		$this->assertArrayHasKey('position[longitude]', $data['validation_error']);
		$this->assertArrayHasKey('position[latitude]', $data['validation_error']);
		$this->assertArrayHasKey('address[street]', $data['validation_error']);
		$this->assertArrayHasKey('address[country]', $data['validation_error']);
		$this->assertArrayHasKey('address[number]', $data['validation_error']);
		$this->assertArrayHasKey('address[city]', $data['validation_error']);

	}

	public function testValidInsert() {

		$body = [
			'name' => 'Mateus',
			'type' => 'ALL',
			'address' => [
				'city' => 'São Leopold',
				'country' => 'Brasil',
				'street' => 'Rua X, 548',
				'state' => 'RS',
				'number' => '548',
				'neighborhood' => 'Centro'
			],
			'position' => [
				'latitude' => '-45.8484',
				'longitude' => '-24.498',
			]
		];

		$res = $this->client()->post('/api/places',['body' => json_encode($body)]);

		$data = json_decode($res->getBody(), true);

		$this->assertEquals(201, $res->getStatusCode());
		$this->assertArrayHasKey('id', $data);
		// ID do elemento criado
		$_id = $data['id'];

		// Testa os dados criados
		$res = $this->client()->get('/api/places/'.$_id);
		$data = json_decode($res->getBody(), true);

		$this->assertEquals(200, $res->getStatusCode());

		// Exclui o elemento
		$res = $this->client()->delete('/api/places/'.$_id);
		$this->assertEquals(202, $res->getStatusCode());

	}

	public function testAvaliate() {

		$body = [
			'name' => 'Mateus',
			'type' => 'ALL',
			'address' => [
				'city' => 'São Leopold',
				'country' => 'Brasil',
				'street' => 'Rua X, 548',
				'state' => 'RS',
				'number' => '548',
				'neighborhood' => 'Centro'
			],
			'position' => [
				'latitude' => '-45.8484',
				'longitude' => '-24.498',
			]
		];

		$res = $this->client()->post('/api/places',['body' => json_encode($body)]);

		$data = json_decode($res->getBody(), true);

		$this->assertEquals(201, $res->getStatusCode());
		$this->assertArrayHasKey('id', $data);
		// ID do elemento criado
		$_id = $data['id'];

		// Atualizando setando avaliate 5 vezes
		for($i = 1; $i < 5; $i++) {
			$res = $this->client()->put('/api/places/'.$_id, ['query' => [
				'avaliate' => '1'
			]]);
		}

		// Atualizando setando 0
		$res = $this->client()->put('/api/places/'.$_id, ['query' => [
			'avaliate' => '0'
		]]);

		// Verifica se o item foi atualizado
		$this->assertEquals(202, $res->getStatusCode());

		// Pega item após editar
		$res = $this->client()->get('/api/places/'.$_id);

		$data = json_decode($res->getBody(), true);

		$this->assertEquals(200, $res->getStatusCode());

		// Verifica se o thumbs_up é igual a 1
		$this->assertEquals(4, $data['thumbs_up']);
		$this->assertEquals(-1, $data['thumbs_down']);

		// Excluindo item
		$res = $this->client()->delete('/api/places/'.$_id);
		$this->assertEquals(202, $res->getStatusCode());

	}

}
