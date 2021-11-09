<?php

namespace App\Service\Criteria;

use App\Service\Criteria\CriteriaInterface;

/**
 * Class that evaluates if the country code begins with vowel
 */
class RegionCriteria implements CriteriaInterface
{

	public function evaluate(string $countryCode, array $restCountryResponse): bool
	{
		return $restCountryResponse['region'] === 'Europe';
	}

}
