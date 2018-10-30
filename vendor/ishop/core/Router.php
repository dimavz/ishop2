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

	public static function dispathch($url)
	{
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

	public static function matchRoute($url)
	{

		foreach (self::$routes as $pattern => $route)
		{
			if (preg_match("#{$pattern}#", $url, $matches))
			{
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
				self::$route = $route;
//				debug(self::$route);
				return true;
			}
		}

		return false;

	}

	//CamelCase
	protected static function upperCamelCase($string)
	{
		$str = str_replace('-',' ',$string);
		$str = ucwords($str);
		$str = str_replace(' ','',$str);
//		debug($str);
		return $str;
	}

	//camelCase
	protected static function lowerCamelCase($string)
	{
		return lcfirst(self::upperCamelCase($string));
	}

}