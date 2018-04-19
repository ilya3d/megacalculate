<?php

namespace MegaCalculate\Model;


/**
 * Реестр математических операций для расчета выражений
 * Class Operators
 * @package MegaCalculate\Model
 */
class Operators
{
	private $_operators = [];
	private $_rules = [];


	/**
	 * Добавление новой операции
	 *
	 * @param string $operator
	 * @param \Closure $resultFunction
	 * @param int $priority
	 * @return Operators
	 */
	public function addOperator(string $operator, \Closure $resultFunction, int $priority = 1): Operators
	{
		$this->_operators[] = $operator;
		$this->_rules[$priority][$operator] = $resultFunction;
		return $this;
	}


	/**
	 * Операции, сгруппированные по приоритету
	 *
	 * @return array
	 */
	public function getList(): array
	{
		return $this->_rules;
	}


	/**
	 * Список доступных операций
	 * @return array
	 */
	public function getAvailableOperators(): array
	{
		return $this->_operators;
	}
}