<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller that contains common methods for api calls
 */
class BaseController extends AbstractFOSRestController
{

	public function getSuccessfulResponse($data): View
	{
		return $this->view($data, JsonResponse::HTTP_OK);
	}

	public function getFailureResponse($data): View
	{
		return $this->view($data, JsonResponse::HTTP_BAD_REQUEST);
	}

}
