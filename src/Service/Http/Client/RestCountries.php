<?php

namespace App\Service\Http\Client;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Description of RestCountries
 *
 * @author memento
 */
class RestCountries
{
	private HttpClient $httpClient;
	private string $url;
	private string $key;
	
	public function __construct(HttpClient $HttpClient, ParameterBagInterface $parameterBag)
	{
		$this->httpClient = $httpClient;
		$this->url= $parameterBag->get('app.api_rest_countries_url');
		$this->key = $parameterBag->get('app.api_rest_countries_key');
	}
	
	/**
	 * 
	 * @param string $country
	 * @return array
	 */
	public function evaluate(string $country):array
	{
		
	}
}
