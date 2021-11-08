<?php

namespace App\Controller\Api;

use App\Controller\Api\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of CheckCountry
 *
 * @Route("check-country", name="check_country", methods="GET")
 */
class CheckCountry extends BaseController
{

	private Request $request;

	public function __construct(RequestStack $request)
	{
		$this->request = $request->getCurrentRequest();
	}

	public function __invoke()
	{
		$countryCode = $this->request->query->get('country-code');
		if (empty($countryCode)) {
			throw new \Exception();
		}

		return $this->getSuccessfulResponse(['code' => 0]);
	}

}
