<?php

namespace App\Service\Criteria;

use App\Service\Criteria\CriteriaInterface;
use App\Service\Http\Client\RestCountriesService;

/**
 * Class that evaluates if country is in Asia region and has a population greater than 80,000 persons
 */
class PopulationCriteria implements CriteriaInterface
{
	
	const REGION = 'Asia';
	const POPULATION_MIN_ASIA = 80000000;
	const POPULATION_MIN_NOT_ASIA = 50000000;
	
	public function evaluate(string $countryCode, array $restCountryResponse): bool
	{
		return ($restCountryResponse['region'] === self::REGION && $restCountryResponse['population'] > self::POPULATION_MIN_ASIA) ||
		($restCountryResponse['region'] !== self::REGION && $restCountryResponse['population'] > self::POPULATION_MIN_NOT_ASIA);
	}

}
