<?php

namespace App\Tests\Service\Http\Client;

use PHPUnit\Framework\TestCase;
use Mockery;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Service\Http\Client\RestCountries;

class RestCountriesTest extends TestCase
{

	public function testMock(): void
	{
//		$response = json_encode([
//			'result' => true,
//			'criteria' => [
//				'code' => true,
//				'region' => true,
//				'population' => true,
//				'rival' => true
//			]
//		]);
//
//		$mock = Mockery::mock('RestCountries');
//		$mock->shouldReceive('getData')->with('ES')->andReturn($response);
//
//		$this->assertEquals($response, $mock->getData('ES'));
	}

	public function testMockGetData(): void
	{
		$httpClient = $this->createMock(HttpClientInterface::class);
		$httpClient->expects($this->any())
				->method('request');

		$parameterBag = $this->createMock(ParameterBagInterface::class);
		$parameterBag->expects($this->any())
				->method('get')
				->willReturn(
						'https://restcountries.com/v3.1/alpha',
						'restcountries.com/v3.1/alpha',
						'2dfaff8260msh71e2602d2fdd8e0p14307djsn8de366b0a61c'
		);

		$translator = $this->createMock(TranslatorInterface::class);
		$translator->expects($this->any())
				->method('trans')
				->with('error.common')
				->willReturn('error');

		$restCountriesService = new RestCountries($httpClient, $parameterBag, $translator);
		$countryData = $restCountriesService->getData('ES');

		$this->assertArrayHasKey('name', $countryData[0]);
	}

	protected function tearDown(): void
	{
		parent::tearDown();

		Mockery::close();
	}

}
