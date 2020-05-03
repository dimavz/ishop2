<?php

namespace ishop;


class App
{
	public static $properties; // Свойство для хранения параметров приложения

	public function __construct()
	{
		$query = trim($_SERVER['QUERY_STRING'], '/'); // Обрезаем концевой слэш из строки запроса
//		debug($query);
//		exit();
		session_start(); // Стартуем сессию
		self::$properties = Registry::getInstance();
		$this->getParams();
		new ErrorHandler();
		Router::dispathch($query);

	}

	protected function getParams(){
		$params = require_once CONFIG.'/params.php';
		if(!empty($params)){
			foreach ($params as $k=>$v){
				self::$properties->setProperty($k,$v);
			}
		}
	}
}