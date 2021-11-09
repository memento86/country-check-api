<?php

namespace App\Service\Criteria;

use App\Service\Criteria\CriteriaInterface;

/**
 * Class that evaluates if the country code begins with vowel
 */
class CodeCriteria implements CriteriaInterface
{

	public function evaluate(string $countryCode, array $restCountryResponse): bool
	{
		return 1 === preg_match('/^[aeiou]/i', $countryCode[0]);
	}

}
