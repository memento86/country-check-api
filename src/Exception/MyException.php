<?php

namespace App\Exception;

use ErrorException;

/**
 * Description of MyException
 *
 * @author memento
 */
class MyException extends ErrorException
{
	public function __construct(string $message = "", int $code = 0, int $severity = E_USER_ERROR)
	{
		parent::__construct($message, $code, $severity);
	}
}
