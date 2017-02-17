<?php

class Calc
{
	private $_exp;
	private $_result;

	public function __construct($exp)
	{
		$this->_exp = $exp;
	}

	public function getResult()
	{
		$this->prepareExp();
		try 
		{
			$this->calculate();
		}
		catch (Exception $e)
		{
			$this->_result = $e->getMessage();
		}
		return $this->_result;
	}

	private function prepareExp()
	{
		$this->_result = [];

		foreach ($this->_exp as $key => $value) 
		{
			if ($value == 'plus')
			{
				$value = '+';
			}
			if ($value == 'minus')
			{
				$value = '-';
			}
			if ($value == 'multiply')
			{
				$value = '*';
			}
			if ($value == 'division')
			{
				$value = '/';
			}

			$this->_result[] = $value;
		}

		$this->_result = implode('', $this->_result);
	}

	private function calculate()
	{	
		$this->_result = eval('if (' . $this->_result . ') return ' . $this->_result . '; else throw new Exception("dbz");');
	}
}