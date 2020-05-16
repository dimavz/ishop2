<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 30.10.2018
 * Time: 15:33
 */

namespace ishop;


class Router
{
	protected static $routes = []; //Свойство для хранения таблицы маршрутов
	protected static $route = [];//Свойство для хранения текущего маршрута

	public static function add($regexp, $route = [])
	{
		self::$routes[$regexp] = $route;
	}

	public static function getRoutes()
	{
		return self::$routes;
	}

	public static function getRoute()
	{
		return self::$route;
	}

	public static function dispatch($url)
	{
		$url = self::removeQueryString($url);
		if (self::matchRoute($url))
		{
			$controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
			if(class_exists($controller))
			{
				$controllerObject = new $controller(self::$route);
				$action = self::lowerCamelCase(self::$route['action']).'Action';
				if(method_exists($controllerObject,$action))
				{
					$controllerObject->$action();
					$controllerObject->getView();
				}
				else{
					throw new \Exception('Метод '. $action .' не найден в контроллере '.$controller, 404);
				}
			}
			else{ // если класс контроллера не существует
				throw new \Exception('Контроллер '. $controller .' не найден', 404);
			}
		}
		else
		{
			throw new \Exception('Страница не найдена', 404);
		}
	}

	// Метод который ищет совпадение в url адресе с патерном из массива маршрутов
	public static function matchRoute($url)
	{
		foreach (self::$routes as $pattern => $route)
		{
//			echo $pattern;
//			debug($route);
			if (preg_match("#{$pattern}#i", $url, $matches)) // Добавлен в патерн символ i, который означает регистронезависимый
			{
//				debug($matches);
//				exit();
				foreach ($matches as $k => $v)
				{
					if (is_string($k))
					{
						$route[$k] = $v;
					}
				}
				if (empty($route['action']))
				{
					$route['action'] = 'index';
				}
				if (!isset($route['prefix']))
				{
					$route['prefix'] = '';
				}
				else
				{
					$route['prefix'] .= '\\';
				}
				$route['controller'] = self::upperCamelCase($route['controller']);
//				debug($route);
//				exit();
				self::$route = $route;

				return true;
			}
		}
		return false;

	}

	//Метод приводит наименование к формату CamelCase
	protected static function upperCamelCase($string)
	{
		$str = str_replace('-',' ',$string);
		$str = ucwords($str);
		$str = str_replace(' ','',$str);
//		debug($str);
		return $str;
	}

	//Метод приводит наименование к формату camelCase
	protected static function lowerCamelCase($string)
	{
		return lcfirst(self::upperCamelCase($string));
	}

	protected static function removeQueryString($url)
	{
		if($url)
		{
			$params = explode('&',$url,2);
			if(strpos($params[0],'=')===false)
			{
				return rtrim($params[0],'/');
			}
			else
			{
				return '';
			}
		}
		return $url;
	}

}