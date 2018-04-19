<?php

namespace Tests\MegaCalculate\Service;

use PHPUnit\Framework\TestCase;
use MegaCalculate\Service\Validator;
use MegaCalculate\Model\Operators;


class ValidatorTest extends TestCase
{
	private $_validator;
	private $_operators;


	protected function setUp()
	{
		$this->_validator = new Validator();

		$this->_operators = (new Operators())
			->addOperator('*', function($a, $b) { return $a * $b; }, 1)
			->addOperator('+', function($a, $b) { return $a + $b; }, 2)
			->addOperator('-', function($a, $b) { return $a - $b; }, 2)
		;
	}


	public function testProcess(): void
	{
		$lexemes = [2, '+', 32, '-', 4, '*', 22];
		$this->assertEmpty($this->_validator->process($lexemes, $this->_operators));
	}


	/**
	 * @expectedException \MegaCalculate\Exceptions\IncorrectExpression
	 */
	public function testProcessEvenLexemes(): void
	{
		$lexemes = [2, '+', 32, '-', 4, '*'];
		$this->assertEmpty($this->_validator->process($lexemes, $this->_operators));
	}


	/**
	 * @expectedException \MegaCalculate\Exceptions\IncorrectExpression
	 */
	public function testProcessWithFirstOperator(): void
	{
		$lexemes = ['+', 32, '-', 4, '*'];
		$this->assertEmpty($this->_validator->process($lexemes, $this->_operators));
	}


	/**
	 * @expectedException \MegaCalculate\Exceptions\IncorrectExpression
	 */
	public function testProcessWithNumbers(): void
	{
		$lexemes = [32, 2, 4, '*', 8];
		$this->assertEmpty($this->_validator->process($lexemes, $this->_operators));
	}


	/**
	 * @expectedException \MegaCalculate\Exceptions\UnknownOperator
	 */
	public function testProcessUnknownOperator(): void
	{
		$lexemes = [32, '+', 4, '^', 8];
		$this->assertEmpty($this->_validator->process($lexemes, $this->_operators));
	}
}