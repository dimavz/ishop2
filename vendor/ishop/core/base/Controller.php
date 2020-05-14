<?php
/**
Абстрактный клаас базового контроллера
 */

namespace ishop\base;


abstract class Controller
{
	public $route; //Свойство для хранения массива с текущим маршрутом.
	public $controller; //Свойство для хранения контроллера.
	public $view; //Свойство для хранения вида.
	public $model; //Свойство для хранения модели.
	public $prefix; //Свойство для хранения префикса.
	public $data =[]; //Свойство для хранения данных.
	public $meta =['title'=>'', 'description'=>'','keywords'=>'']; //Свойство для хранения метаданных.
	public $layout = LAYOUT; //Свойство для хранения макета страницы.

	public function __construct($route)
	{
		$this->route = $route;
		$this->controller = $route['controller'];
		$this->view = $route['action'];
		$this->model = $route['controller']; // Модель будет называться так же как и контроллер
		$this->prefix = $route['prefix'];
	}

	public function getView()
	{
		$viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
		$viewObject->render($this->data);
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function setMeta($title='',$description ='', $keywords='')
	{
		$this->meta['title'] = $title;
		$this->meta['description'] = $description;
		$this->meta['keywords'] = $keywords;
	}

    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = []){
        extract($vars);
        require APP . "/views/{$this->prefix}{$this->controller}/{$view}.php";
        die;
    }

}