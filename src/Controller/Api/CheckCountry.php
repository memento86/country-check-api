<?php

namespace App\Controller\Api;

use App\Controller\Api\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use App\Exception\MyException;
use App\Service\CheckCountryService;
use App\Dto\CheckCountryDto;

/**
 * Description of CheckCountry
 *
 * @Route("check-country", name="check_country", methods="GET")
 * @OA\Response(
 *		response=200,
 *		description="Returns the result and criterias",
 *		@OA\JsonContent(ref=@Model(type=CheckCountryDto::class))
 * )
 * @OA\Response(
 *		response=404,
 *		description="If country-code is not sended or is empty, it returns an error",
 *		@OA\JsonContent(
 *			type="object",
 *			example={"code": 404, "message": "The country-code field is required"}
 *		)
 * )
 * @OA\Response(
 *		response=500,
 *		description="Generic error",
 *		@OA\JsonContent(
 *			type="object",
 *			example={"code": 500, "message": "The country-code field is required"}
 *		)
 * )
 * @OA\Parameter(
 *		name="country-code",
 *		in="query",
 *		description="Country code. For example, es for Spain, fr for France, ...",
 *		@OA\Schema(type="string")
 * )
 * @OA\Tag(name="Check criterias by country")
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
			throw new MyException($this->translator->trans('error.field_country_code_empty'), JsonResponse::HTTP_NOT_FOUND);
		}
		
		$checkCountryDto = $this->checkCountryService->evaluate($countryCode);

		return $this->getSuccessfulResponse($checkCountryDto);
	}

}
