<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 30.10.2018
 * Time: 11:05
 */

namespace ishop;


class Registry
{
	use TSingletone; //Вставляем трэйт реализующий шаблон проектирования singletone

	protected static $properties = [];

	public function setProperty($key, $value)
	{
		self::$properties[$key] = $value;
	}

	public function getProperty($key)
	{
		if (isset(self::$properties[$key]))
		{
			return self::$properties[$key];
		}

		return null;
	}

	public function getProperties(){
		return self::$properties;
	}

}