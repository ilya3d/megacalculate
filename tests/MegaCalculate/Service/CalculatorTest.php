<?php

namespace Tests\MegaCalculate\Service;

use PHPUnit\Framework\TestCase;
use MegaCalculate\Service\Calculator;
use MegaCalculate\Model\Operators;


class CalculatorTest extends TestCase
{
	private $_calculator;
	private $_operators;


	protected function setUp()
	{
		$this->_calculator = new Calculator();

		$this->_operators = (new Operators())
			->addOperator('*', function($a, $b) { return $a * $b; }, 1)
			->addOperator('+', function($a, $b) { return $a + $b; }, 2)
			->addOperator('-', function($a, $b) { return $a - $b; }, 2)
		;
	}

	/**
	 * @dataProvider addDataProvider
	 */
	public function testProcess(array $lexemes, string $output): void
	{
		$this->assertEquals(
			$output,
			$this->_calculator->process($lexemes, $this->_operators)
		);
	}


	public function addDataProvider()
	{
		return [
			[[2, '+', 3, '*', 2, '-', 2, '+', 1], '7'],
			[[2, '*', 3, '+', 22, '-', 2, '*', 1], '26'],
			[[1, '+', 2, '+', 3, '+', 4], '10'],
			[[1, '*', 2, '*', 3, '*', 4], '24'],
			[[10, '-', 2, '*', 3], '4'],
		];
	}
}