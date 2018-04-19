<?php

namespace MegaCalculate\Service;

use MegaCalculate\Exceptions;
use MegaCalculate\Model\Operators;


/**
 * Валидатор проверяет набор лекем на соответствие
 * валидному математическому выражению
 *
 * Class Validator
 * @package MegaCalculate\Service
 */
class Validator
{

	public function process(array $lexemes, Operators $operators): void
	{
		$availableOperators = $operators->getAvailableOperators();

		// операций на одну меньше чем чисел и в сумме нечетное кол-во лексем
		if (count($lexemes) % 2 == 0)
			throw new Exceptions\IncorrectExpression();

		foreach ($lexemes as $i => $lexeme)
		{
			if ($i % 2 == 0)
			{
				// на нечетных позициях (счет с 0) должны быть числа
				if (!is_numeric($lexeme))
					throw new Exceptions\IncorrectExpression();
			}
			else
			{
				// на четных не цифры, а операции
				if (is_numeric($lexeme))
					throw new Exceptions\IncorrectExpression();

				// и операции из числа доступных
				if (!in_array($lexeme, $availableOperators))
					throw new Exceptions\UnknownOperator();
			}

		}
	}
}