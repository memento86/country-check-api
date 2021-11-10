<?php

namespace App\Service\Criteria;

use App\Service\Criteria\CriteriaInterface;
use App\Service\Http\Client\RestCountriesService;

/**
 * Class that evaluates if country has a population greater than Norway.
 */
class RivalCriteria implements CriteriaInterface
{

	private RestCountriesService $restCountriesService;
	const NORWAY_CODE = 'NO';

	public function __construct(RestCountriesService $restCountriesService)
	{
		$this->restCountriesService = $restCountriesService;
	}

	public function evaluate(string $countryCode, array $restCountryResponse): bool
	{
		$countryCodeData = $this->restCountriesService->getData($countryCode);
		$norwayData = $this->restCountriesService->getData(self::NORWAY_CODE);
		
		return $countryCodeData['population'] > $norwayData['population'];
	}

}
