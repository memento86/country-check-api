<?php

namespace App\Tests\Service\Criteria;

use PHPUnit\Framework\TestCase;
use App\Service\Criteria\PopulationCriteria;

class PopulationCriteriaTest extends TestCase
{

	public function testCriteria(): void
	{
		$populationCriteria = new PopulationCriteria();
		$result = $populationCriteria->evaluate('it', [
			'region' => 'Asia',
			'population' => 600000,
		]);

		$this->assertIsBool($result);
		$this->assertEquals(false, $result);
	}

}
