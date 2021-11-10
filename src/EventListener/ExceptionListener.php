<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Exception\MyException;

class ExceptionListener
{
	
	private TranslatorInterface $translator;
	
	public function __construct(TranslatorInterface $translator)
	{
		$this->translator = $translator;
	}

	public function onKernelException(ExceptionEvent $event)
	{
		// You get the exception object from the received event
		$exception = $event->getThrowable();
		
		$statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
		$headers = [];
		$content = [
			'code'=> 0,
			'message' => $this->translator->trans('error.common'),
		];

		// HttpExceptionInterface is a special type of exception that
		// holds status code and header details
		if ($exception instanceof HttpExceptionInterface) {
			$statusCode = $exception->getStatusCode();
			$headers = $exception->getHeaders();
		} elseif ($exception instanceof MyException) {
			$statusCode = $exception->getCode() != 0 ? $exception->getCode() : JsonResponse::HTTP_BAD_REQUEST;
			$content['message'] = $exception->getMessage();
		}

		$content['code'] = $statusCode;
		$jsonContent = json_encode($content);
		$headers['Content-Type'] = 'application/json';
		
		// Customize your response object to display the exception details
		$response = new Response($jsonContent, $statusCode, $headers);
		
		// sends the modified response object to the event
		$event->setResponse($response);
		
		//TODO: save log
	}

}
