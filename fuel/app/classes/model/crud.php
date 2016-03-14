<?php

class Model_Crud extends Fuel\Core\Model_Crud
{
	/**
	* @see \Fuel\Core\Model_Crud::__get()
	*/
	public function __get($property)
	{
		if (!array_key_exists($property, $this->_data) && in_array($property, static::$_properties)) {
			$this->_data[$property] = null;
			if (isset(static::$_defaults) && isset(static::$_defaults[$property])) {
				$this->_data[$property] = static::$_defaults[$property];
			}
		}
		return parent::__get($property);
	}
	
	/**
	* @return mixed object id
	*/
	public function id()
	{
		return $this->{static::primary_key()};
	}
}