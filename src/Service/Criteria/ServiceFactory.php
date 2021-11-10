<?php

namespace App\Service\Criteria;

//use Symfony\Component\DependencyInjection\ContainerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Util\CamelCase;
use App\Exception\MyException;

/**
 * Class to gets a criteria service by criteria type
 */
class ServiceFactory
{
	private ContainerInterface $container;
	private TranslatorInterface $translator;
	const NAMESPACE = 'App\\Service\\Criteria\\';
	
	public function __construct(ContainerInterface $container, TranslatorInterface $translator)
	{
		$this->container = $container;
		$this->translator = $translator;
	}
	
	public function getService(string $criteriaType)
	{
		$camelCaseCriteriaType = CamelCase::transformSingleWord($criteriaType);
		$className = self::NAMESPACE.$camelCaseCriteriaType.'Criteria';
		if(!class_exists($className)){
			throw new MyException($this->translator->trans('error.common'));
		}
		
		return $this->container->get($className);
	}
}
