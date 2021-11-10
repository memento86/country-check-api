<?php

namespace App\Service\Http\Client;

/**
 * 
 */
interface RestCountriesInterface
{
	
	/**
	 * Method that returns information about country
	 * 
	 * @param string $countryCode
	 * @return array
	 */
	public function getData(string $countryCode): array;
}
