<?php

namespace Tests\MegaCalculate;

use MegaCalculate\Facade;
use PHPUnit\Framework\TestCase;


class FacadeTest extends TestCase
{
	private $_facade;


	protected function setUp()
	{
		$this->_facade = new Facade();
	}


	/**
	 * @dataProvider addDataProvider
	 */
	public function testProcess(string $result, string $input): void
	{
		$this->assertEquals(
			$result,
			$this->_facade->calculate($input)
		);
	}


	public function addDataProvider()
	{
		return [
			['2', '1+1'],
			['50', '22*2-4+10'],
			['Ошибка! Не корректное выражение.', '4-3++9'],
			['Ошибка! Неизвестный оператор в выражении', '4-3^9'],
		];
	}

}