<?php

namespace App\Controller\Api;

use App\Controller\Api\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Exception\MyException;

/**
 * Description of CheckCountry
 *
 * @Route("check-country", name="check_country", methods="GET")
 */
class CheckCountry extends BaseController
{

	private Request $request;
	private TranslatorInterface $translator;

	public function __construct(RequestStack $request, TranslatorInterface $translator)
	{
		$this->request = $request->getCurrentRequest();
		$this->translator = $translator;
	}

	public function __invoke()
	{
		$countryCode = $this->request->query->get('country-code');
		if (empty($countryCode)) {
			throw new MyException($this->translator->trans('error.field_country_code_empty'));
		}

		return $this->getSuccessfulResponse(['code' => 0]);
	}

}
