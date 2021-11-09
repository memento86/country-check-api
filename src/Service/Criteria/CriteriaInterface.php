<?php

namespace App\Service\Criteria;

/**
 * Description of CriteriaInterface
 */
interface CriteriaInterface
{

	public function evaluate(string $countryCode, array $restCountryResponse): bool;
}
