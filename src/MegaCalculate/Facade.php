<?php

namespace MegaCalculate;

/**
 * Библиотека для вычисления математических выражений
 * Class Facade
 * @package MegaCalculate
 */
class Facade
{
	const MY_STRATEGY = 'MyStrategy';
	const WOLFRAM_STRATEGY = 'Wolfram';


	public function calculate(string $s, string $strategy = self::MY_STRATEGY): string
	{
		return $this->_getStrategy($strategy)->process($s);
	}


	private function _getStrategy(string $strategy): ICalculateStrategy
	{
		if ($strategy == self::WOLFRAM_STRATEGY)
			throw new BaseException('Not supported strategy');

		return new MyCalculator();
	}
}