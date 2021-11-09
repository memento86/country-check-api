<?php

namespace App\Dto;

use App\Dto\CriteriaDto;

/**
 * 
 */
class CheckCountryDto
{
	private bool $result;
	private CriteriaDto $criteria;
	
	function getResult(): bool
	{
		return $this->result;
	}

	function setResult(bool $result): void
	{
		$this->result = $result;
	}

	function getCriteria(): CriteriaDto
	{
		return $this->criteria;
	}

	function setCriteria(CriteriaDto $criteria): void
	{
		$this->criteria = $criteria;
	}

}
