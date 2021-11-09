<?php

namespace App\Service\Criteria;

use App\Service\Criteria\CriteriaInterface;

/**
 * Class that evaluates if country has a population greater than Norway.
 */
class RivalCriteria implements CriteriaInterface
{

	public function evaluate(string $countryCode, array $restCountryResponse): bool
	{
		return ($restCountryResponse['region'] === 'Asia' && $restCountryResponse['population'] > 80000000) ||
		($restCountryResponse['region'] !== 'Asia' && $restCountryResponse['population'] > 50000000);
	}

}
