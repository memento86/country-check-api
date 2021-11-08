<?php

namespace App\Tests\Service\Http\Client;

use PHPUnit\Framework\TestCase;
use Mockery;

class RestCountriesTest extends TestCase
{
    public function testMock(): void
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
		
		$mock = Mockery::mock('RestCountries');
		$mock->shouldReceive('evaluate')->with('ES')->andReturn($response);
		
		$this->assertEquals($response, $mock->evaluate('ES'));
    }
}
