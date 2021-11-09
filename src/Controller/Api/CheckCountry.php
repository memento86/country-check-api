<?php

namespace App\Controller\Api;

use App\Controller\Api\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Exception\MyException;
use App\Service\CheckCountryService;
use App\Dto\CheckCountryDto;

/**
 * Description of CheckCountry
 *
 * @Route("check-country", name="check_country", methods="GET")
 */
class CheckCountry extends BaseController
{

	private Request $request;
	private TranslatorInterface $translator;
	private SerializerInterface $serializer;
	private CheckCountryService $checkCountryService;

	public function __construct(
			RequestStack $request,
			TranslatorInterface $translator,
			SerializerInterface $serializer,
			CheckCountryService $checkCountryService)
	{
		$this->request = $request->getCurrentRequest();
		$this->translator = $translator;
		$this->serializer = $serializer;
		$this->checkCountryService = $checkCountryService;
	}

	public function __invoke()
	{
		$countryCode = $this->request->query->get('country-code');
		if (empty($countryCode)) {
			throw new MyException($this->translator->trans('error.field_country_code_empty'));
		}
		
		$checkCountryDto = $this->checkCountryService->evaluate($countryCode);

		return $this->getSuccessfulResponse($checkCountryDto);
	}

}
