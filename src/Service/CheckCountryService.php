<?php

namespace App\Service;

use App\Service\Http\Client\RestCountriesService;
use App\Dto\CheckCountryDto;
use App\Dto\CriteriaDto;
use App\Service\Criteria\ServiceFactory as CriteriaServiceFactory;
use App\Service\Criteria\CriteriaInterface;

/**
 * 
 */
class CheckCountryService
{

	private $countryCode;
	private RestCountriesService $restCountriesService;
	private CriteriaServiceFactory $criteriaServiceFactory;

	const CRITERIA_TYPE_CODE = 'CODE';
	const CRITERIA_TYPE_POPULATION = 'POPULATION';
	const CRITERIA_TYPE_REGION = 'REGION';
	const CRITERIA_TYPE_RIVAL = 'RIVAL';
	const CRITERIA_TYPES = [
		self::CRITERIA_TYPE_CODE,
		self::CRITERIA_TYPE_POPULATION,
		self::CRITERIA_TYPE_REGION,
		self::CRITERIA_TYPE_RIVAL,
	];

	public function __construct(
			RestCountriesService $restCountriesService,
			CriteriaServiceFactory $criteriaServiceFactory)
	{
		$this->restCountriesService = $restCountriesService;
		$this->criteriaServiceFactory = $criteriaServiceFactory;
	}

	/**
	 * Method that returns the result of the evaluation of differents criterias
	 * @param string $countryCode
	 * @return CheckCountryDto
	 */
	public function evaluate(string $countryCode): CheckCountryDto
	{
		$this->countryCode = $countryCode;
		$restCountryResponse = $this->restCountriesService->getData($countryCode);

		$criteriaDto = new CriteriaDto();
		$result = true;
		foreach (self::CRITERIA_TYPES as $criteriaType) {
			/** @var CriteriaInterface $criteriaService*/
			$criteriaService = $this->criteriaServiceFactory->getService($criteriaType);
			$criteriaResult = $criteriaService->evaluate($countryCode, $restCountryResponse);
			
			$method = 'set' . ucwords(strtolower($criteriaType));
			$criteriaDto->$method($criteriaResult);
			
			if(!$criteriaResult){
				$result = false;
			}
		}

		$checkCountryDto = new CheckCountryDto();
		$checkCountryDto->setResult($result);
		$checkCountryDto->setCriteria($criteriaDto);

		return $checkCountryDto;
	}

	private function calculateResult(CriteriaDto $criteriaDto)
	{
		$result = true;
		foreach (self::CRITERIA_TYPES as $criteriaType) {
			$method = 'get' . ucwords(strtolower($criteriaType));
			if (false === $criteriaDto->$method()) {
				$result = false;
				break;
			}
		}

		return $result;
	}

}
