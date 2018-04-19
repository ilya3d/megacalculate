<?php

namespace MegaCalculate\Service;

use MegaCalculate\Model\Operators;


/**
 * Вычисление математического выражения
 *
 * Class Calculator
 * @package MegaCalculate\Service
 */
class Calculator
{
	public function process(array $lexemes, Operators $operators): string
	{
		foreach ($operators->getList() as $priority => $currentOperators)
			for ($i = 0; $i < count($lexemes); $i++)
				while (array_key_exists($operator = ($lexemes[$i] ?? ''), $currentOperators))
				{
					$lexemes[$i - 1] = $currentOperators[$operator]($lexemes[$i - 1], $lexemes[$i + 1]);
					array_splice($lexemes, $i, 2);
				}

		return (string)$lexemes[0];
	}
}