<?php

namespace App\Service\Http\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Service\Http\Client\RestCountriesInterface;
use App\Exception\MyException;

/**
 * Description of RestCountries
 */
class RestCountriesService implements RestCountriesInterface
{

	private HttpClientInterface $httpClient;
	private TranslatorInterface $translator;
	private string $url;
	private string $host;
	private string $key;

	public function __construct(
			HttpClientInterface $httpClient,
			ParameterBagInterface $parameterBag,
			TranslatorInterface $translator
	)
	{
		$this->httpClient = $httpClient;
		$this->translator = $translator;
		$this->url = $parameterBag->get('app.api_rest_countries_url');
		$this->host = $parameterBag->get('app.api_rest_countries_host');
		$this->key = $parameterBag->get('app.api_rest_countries_key');
	}

	/**
	 * Method that returns information about country
	 * 
	 * @param string $countryCode
	 * @return array
	 * @throws MyException
	 */
	public function getData(string $countryCode): array
	{
		$apiResponse = $this->callApi($countryCode);

		if (200 !== $apiResponse->getStatusCode()) {
			throw new MyException($this->translator->trans('error.common'));
		}

		return $apiResponse->toArray()[0];
	}

	/**
	 * Method that does the rest call
	 * 
	 * @param string $countryCode
	 * @return array
	 */
	private function callApi(string $countryCode)
	{
		$apiResponse = $this->httpClient->request('GET', $this->url, [
			'headers' => [
				'x-rapidapi-host' => $this->host,
				'x-rapidapi-key' => $this->key,
			],
			'query' => [
				'codes' => $countryCode
			],
			'max_redirects' => 10,
			'timeout' => 30,
		]);

		return $apiResponse;
	}

}
