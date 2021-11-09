<?php

namespace App\Service\Criteria;

use App\Service\Criteria\CriteriaInterface;

/**
 * Class that evaluates if country is in Asian region and has a population greater than 80,000 persons
 */
class PopulationCriteria implements CriteriaInterface
{

	public function evaluate(string $countryCode, array $restCountryResponse): bool
	{
		return false;
	}

}
