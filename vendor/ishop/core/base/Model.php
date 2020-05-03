<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.11.2018
 * Time: 13:04
 */

namespace ishop\base;
use ishop\Db;

abstract class Model
{
	public $attributes = []; //Свойство для хранения массива свойств модели, который будет идентичен полям в таблице БД
	public $errors = []; //Свойство для хранения массива ошибок
	public $rules = []; //Свойство для хранения массива правил валидации данных

	public function __construct()
	{
		Db::getInstance();
	}

}