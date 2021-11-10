<?php

namespace App\Util;

/**
 * Class to applies Camel Case format to a word
 */
class CamelCase
{
	public static function transformSingleWord(string $word)
	{
		return ucwords(strtolower($word));
	}
}
