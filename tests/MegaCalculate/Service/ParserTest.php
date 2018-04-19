<?php

namespace Tests\MegaCalculate\Service;

use PHPUnit\Framework\TestCase;
use MegaCalculate\Service\Parser;


class ParserTest extends TestCase
{
	private $_parser;


	protected function setUp()
	{
		$this->_parser = new Parser();
	}


	/**
	 * @dataProvider addDataProvider
	 */
	public function testProcess(string $input, array $lexemes): void
	{
		$this->assertEquals(
			$lexemes,
			$this->_parser->process($input)
		);
	}


	public function addDataProvider()
	{
		return [
			['2+34*245-432+1', [2, '+', 34, '*', 245, '-', 432, '+', 1]],
			['22*2-4+10', [22, '*', 2, '-', 4, '+', 10]],
			['2', [2]],
			['999', [999]],
			['*', ['*']],
			['+-+', ['+', '-', '+']],
			['-77-20-8*5', [-77, '-', 20, '-', 8, '*', 5]],
		];
	}
}