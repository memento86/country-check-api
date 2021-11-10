<?php

namespace App\Tests\Dto;

use PHPUnit\Framework\TestCase;
use Mockery;

class CheckCountryResponseTest extends TestCase
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
		
		$mock = Mockery::mock('CheckCountryResponse');
		$mock->shouldReceive('setResult')->with(true)->andReturnSelf();
		$mock->shouldReceive('getResult')->andReturnValues([true, false]);
		
//		$this->assertEquals($mock->setResult(true), $mock);
//		$this->assertIsBool($mock->getResult());
		$this->assertEquals($mock->getResult(), true);
		$this->assertEquals($mock->getResult(), false);
    }
}
