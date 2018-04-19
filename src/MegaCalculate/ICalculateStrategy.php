<?php

namespace MegaCalculate;


interface ICalculateStrategy
{
	public function process(string $input): string;
}