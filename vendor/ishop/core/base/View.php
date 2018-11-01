<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 01.11.2018
 * Time: 14:49
 * Абстрактный класс Вида
 */

namespace ishop\base;


class View
{
	public $route; //Свойство для хранения массива с текущим маршрутом.
	public $controller; //Свойство для хранения контроллера.
	public $view; //Свойство для хранения вида.
	public $model; //Свойство для хранения модели.
	public $prefix; //Свойство для хранения префикса.
	public $data = []; //Свойство для хранения данных.
	public $meta = []; //Свойство для хранения метаданных.
	public $layout; //Свойство для хранения шаблона.

	public function __construct($route, $layout = '', $view = '', $meta)
	{
		$this->route      = $route;
		$this->controller = $route['controller'];
		$this->view       = $view;
		$this->model      = $route['controller']; // Модель будет называться так же как и контроллер
		$this->prefix     = $route['prefix'];
		$this->meta       = $meta;
		if ($layout === false)
		{
			$this->layout = false;
		}
		else
		{
			$this->layout = $layout ?: LAYOUT;
		}
	}

	//Метод который формирует сираницу для пользователя
	public function render($data)
	{
		$fileView = APP."/views/{$this->prefix}{$this->controller}/{$this->view}.php";

		if(file_exists($fileView))
		{
//			Файл существует
			//Включаем буферизацию, так как нам не нужно что бы Вид выводился сразу, а нам его необходимо вставить в макет (layout)
			ob_start();
			require_once $fileView;
			$content = ob_get_clean(); //Присвоим всё из буфера в переменную $content и очистим буфер. Всё содержимое буфера храниться у нас в переменной $content
//			и мы можем это содержимое вывести в любой момент

		}
		else{
//		Файл НЕ существует
			throw new \Exception("Не найден вид {$pahtViewFile}", 404);
		}
	}
}