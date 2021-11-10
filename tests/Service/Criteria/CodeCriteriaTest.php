<?php

namespace App\Tests\Service\Criteria;

use PHPUnit\Framework\TestCase;
use App\Service\Criteria\CodeCriteria;

class CodeCriteriaTest extends TestCase
{

	public function testCriteria(): void
	{
		$codeCriteria = new CodeCriteria();
		$result = $codeCriteria->evaluate('es', []);

		$this->assertIsBool($result);
		$this->assertEquals(true, $result);
	}

}
