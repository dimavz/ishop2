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
	public $metadata; //Свойство для хранения сгенерированного кода метаданных.
	public $layout; //Свойство для хранения шаблона.
	public $content; //Свойство для хранения данных контента.

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
//		debug($data);
//		exit();
		if(is_array($data))extract($data);

		$fileView = APP."/views/{$this->prefix}{$this->controller}/{$this->view}.php";

		if(file_exists($fileView))
		{
//			Файл существует
			//Включаем буферизацию, так как нам не нужно что бы Вид выводился сразу, а нам его необходимо вставить в макет (layout)
			ob_start();
			require_once $fileView;
			$this->content = ob_get_clean(); //Присвоим всё из буфера в переменную $content и очистим буфер. Всё содержимое буфера храниться у нас в переменной $content
//			и мы можем это содержимое вывести в любой момент

		}
		else{
//		Файл НЕ существует
			throw new \Exception("Не найден вид {$fileView}", 500);
		}

		if($this->layout !== false)
		{
			$fileLayout = APP."/views/layouts/{$this->layout}.php";
			if(file_exists($fileLayout))
			{
				$this->metadata = $this->getMeta();
				require_once $fileLayout;

			}
			else
			{
				//Файл НЕ существует
				throw new \Exception("Не найден макет {$fileLayout}", 500);
			}
		}
	}

	public function getMeta()
	{
		$output ='';
		if($this->meta !='' && is_array($this->meta))
		{
			$output ='<meta name="description" content="'.$this->meta['description'].'">'.PHP_EOL;
			$output.="\t".'<meta name="keywords" content="'.$this->meta['keywords'].'">'.PHP_EOL;
			$output.="\t".'<title>'.$this->meta['title'].'</title>'.PHP_EOL;
		}
		return $output;
	}
}