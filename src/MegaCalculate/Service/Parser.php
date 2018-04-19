<?php

namespace MegaCalculate\Service;


/**
 * Парсер, разбивает входную строку на набор лексем
 *
 * Class Parser
 * @package MegaCalculate\Service
 */
class Parser
{

	public function process(string $input): array
	{
		$lexemes = [];
		$lexCounter = 0;
		for ($charCounter = 0; $charCounter < strlen($input); $charCounter++)
		{
			$char = $input[$charCounter];

			if (is_numeric($char))
			{
				if ($lexCounter > 0 && is_numeric($lexemes[$lexCounter-1]))
					$lexemes[$lexCounter-1] = $lexemes[$lexCounter-1] * 10 + (int)$char;
				else
				{
					$lexemes[] = (int)$char;
					$lexCounter++;
				}
			}
			else
			{
				$lexemes[] = $char;
				$lexCounter++;
			}
		}

		// обрабатываем случай, когда первое число отрицательное
		if (count($lexemes) > 1 && $lexemes[0] == '-' && is_numeric($lexemes[1]))
		{
			$lexemes[1] *= -1;
			array_shift($lexemes);
		}

		return $lexemes;
	}
}