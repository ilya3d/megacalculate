<?php

namespace MegaCalculate;


use MegaCalculate\Exceptions\IncorrectExpression;
use MegaCalculate\Exceptions\UnknownOperator;

/**
 * Реализация
 *
 * Class MyCalculator
 * @package MegaCalculate
 */
class MyCalculator implements ICalculateStrategy
{
	private $_operators;

	public function __construct()
	{
		$this->_operators = (new Model\Operators())
			->addOperator('*', function($a, $b) { return $a * $b; }, 1)
			->addOperator('+', function($a, $b) { return $a + $b; }, 2)
			->addOperator('-', function($a, $b) { return $a - $b; }, 2)
		;
	}

	public function process(string $input): string
	{
		try
		{

			$lexemes = (new Service\Parser())->process($input);

			(new Service\Validator())->process($lexemes, $this->_operators);

			return (new Service\Calculator())->process($lexemes, $this->_operators);

		} catch (IncorrectExpression $e) {

			return 'Ошибка! Не корректное выражение.';
		} catch (UnknownOperator $e) {

			return 'Ошибка! Неизвестный оператор в выражении';
		} catch (BaseException $e) {

			return 'Ошибка!';
		}
	}
}