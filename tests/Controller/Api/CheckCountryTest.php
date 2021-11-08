<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Controller\Api\CheckCountry;
use Mockery;

class CheckCountryTest extends WebTestCase
{

	public function testMock()
	{
		$response = json_encode([
			'result' => true,
			'criteria' => [
				'code' => true,
				'region' => true,
				'population' => true,
				'rival' => true
			]
		]);

		$mock = Mockery::mock('CheckCountry');
		$mock->shouldReceive('__invoke')->andReturn($response);

		$this->assertEquals($response, $mock->__invoke());
		$this->assert($response, $mock->__invoke());
	}

	public function testRequest(): void
	{

		$client = static::createClient();
		$crawler = $client->request('GET', '/api/check-country', ['country-code' => 'es']);

		$response = $client->getResponse();
		$jsonContentResponse = json_decode($response->getContent(), true);

		$this->assertResponseIsSuccessful();
		$this->assertEquals(200, $response->getStatusCode());
		$this->assertArrayHasKey('result', $jsonContentResponse);
		$this->assertArrayHasKey('criteria', $jsonContentResponse);
	}

}
