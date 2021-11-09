<?php

namespace App\Service;

use App\Service\Http\Client\RestCountriesService;
use App\Dto\CheckCountryDto;
use App\Dto\CriteriaDto;

/**
 * 
 */
class CheckCountryService
{

	private $countryCode;
	private RestCountriesService $restCountriesService;
	const CRITERIA_TYPE_CODE = 'code';
	const CRITERIA_TYPE_POPULATION = 'population';
	const CRITERIA_TYPE_REGION = 'region';
	const CRITERIA_TYPE_RIVAL = 'rival';
	const CRITERIA_TYPES = [
		self::CRITERIA_TYPE_CODE,
		self::CRITERIA_TYPE_POPULATION,
		self::CRITERIA_TYPE_REGION,
		self::CRITERIA_TYPE_RIVAL,
	];
	
	
	public function __construct(RestCountriesService $restCountriesService)
	{
		$this->restCountriesService = $restCountriesService;
	}

	/**
	 * Method that returns the result of the evaluation of differents criterias
	 * @param string $countryCode
	 * @return CheckCountryDto
	 */
	public function evaluate(string $countryCode): CheckCountryDto
	{
		$this->countryCode = $countryCode;

		$criteriaDto = new CriteriaDto();
		$criteriaDto->setCode(true);
		$criteriaDto->setPopulation(true);
		$criteriaDto->setRegion(false);
		$criteriaDto->setRival(true);

		$checkCountryDto = new CheckCountryDto();
		$checkCountryDto->setResult($this->calculateResult($criteriaDto));
		$checkCountryDto->setCriteria($criteriaDto);

		return $checkCountryDto;
	}

	private function calculateResult(CriteriaDto $criteriaDto)
	{
		$result = true;
		foreach (self::CRITERIA_TYPES as $criteriaType) {
			$method = 'get'.$criteriaType;
			if(false === $criteriaDto->$method()){
				$result = false;
				break;
			}
		}
		
		return $result;
	}
}
