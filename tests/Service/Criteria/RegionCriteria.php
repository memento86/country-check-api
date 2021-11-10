<?php

namespace App\Tests\Service\Criteria;

use PHPUnit\Framework\TestCase;
use App\Service\Criteria\RegionCriteria;

class RegionCriteria extends TestCase
{
	
	public function testCriteria(): void
	{
		
		$regionCriteria = new RegionCriteria();
		$result = $regionCriteria->evaluate('en', ['region' => 'Africa']);

		$this->assertIsBool($result);
		$this->assertEquals(false, $result);
	}
}
