<?php

namespace App\Dto;

/**
 * 
 */
class CriteriaDto
{
	private bool $code;
	private bool $region;
	private bool $population;
	private bool $rival;
	
	public function getCode(): bool
	{
		return $this->code;
	}

	public function setCode(bool $code): void
	{
		$this->code = $code;
	}

	public function getRegion(): bool
	{
		return $this->region;
	}

	public function setRegion(bool $region): void
	{
		$this->region = $region;
	}

	public function getPopulation(): bool
	{
		return $this->population;
	}

	public function setPopulation(bool $population): void
	{
		$this->population = $population;
	}

	public function getRival(): bool
	{
		return $this->rival;
	}

	public function setRival(bool $rival): void
	{
		$this->rival = $rival;
	}


}
