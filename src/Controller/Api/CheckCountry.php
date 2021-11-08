<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of CheckCountry
 *
 * @Route("check-country", name="check_country", methods="GET")
 */
class CheckCountry extends AbstractFOSRestController
{

	private Request $request;

	public function __construct(RequestStack $request)
	{
		$this->request = $request->getCurrentRequest();
	}

	public function __invoke()
	{
		$countryCode = $this->request->request->get('country-code');
		if (empty($countryCode)) {
			throw new \Exception();
		}

		return $this->view(['code' => 0], JsonResponse::HTTP_OK);
	}

}
