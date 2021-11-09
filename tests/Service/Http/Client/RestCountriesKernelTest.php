<?php

namespace App\Tests\Service\Http\Client;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Service\Http\Client\RestCountries;

class RestCountriesKernelTest extends KernelTestCase
{
	
	public function testMockGetData(): void
	{
		$kernel = self::bootKernel();
		
		$container = self::$container;
		
		$httpClient = $container->get(HttpClientInterface::class);
		$parameterBag = $container->get(ParameterBagInterface::class);
		$translator = $container->get(TranslatorInterface::class);
		
		$restCountriesService = new RestCountries($httpClient, $parameterBag, $translator);
		$countryData = $restCountriesService->getData('ES');

		$this->assertIsArray($countryData);
		$this->assertArrayHasKey('name', $countryData[0]);
		$this->assertEquals('Spain', $countryData[0]['name']['common']);
	}
}
