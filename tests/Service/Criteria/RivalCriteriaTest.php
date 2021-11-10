<?php

namespace App\Tests\Service\Criteria;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\Criteria\RivalCriteria;
use App\Service\Http\Client\RestCountriesService;

class RivalCriteriaTest extends KernelTestCase
{
	
	public function testCriteria(): void
	{
		$kernel = self::bootKernel();

		$container = self::$container;

		$restCountriesService = $container->get(RestCountriesService::class);
		
		$rivalCriteria = new RivalCriteria($restCountriesService);
		$result = $rivalCriteria->evaluate('pt', []);

		$this->assertIsBool($result);
		$this->assertEquals(true, $result);
	}
}
