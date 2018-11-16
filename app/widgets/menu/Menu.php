<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 16.11.2018
 * Time: 14:46
 */

namespace app\widgets\menu;


use ishop\App;
use ishop\Cache;
use \RedBeanPHP\R as R;

class Menu
{
	protected $data; // Свойство для данных
	protected $tree; // Свойство для построения дерева меню из данных
	protected $menuHtml; // Свойство для хранения готового Html кода меню
	protected $tpl; // Свойство для хранения шаблона меню
	protected $container = 'ul'; // Свойство для хранения тэга контейнера меню
	protected $table = 'category'; // Свойство для хранения таблицы из которой выбираются данные для меню
	protected $cache = 3600; // Свойство для хранения времени жизни кэша данных меню
	protected $cacheKey = 'ishop_menu'; // Свойство для хранения ключа кэша
	protected $attrs = []; // Свойство для хранения атрибутов меню
	protected $prepend = ''; // Свойство для хранения префикса

	public function __construct($options=[])
	{
		$this->tpl = __DIR__ .'/template/menu_tpl.php';
		$this->getOptions($options);
//		debug($this->table);
		$this->run();
	}

	protected function getOptions($options)
	{
		if(is_array($options))
		{
			foreach ($options as $k=>$option)
			{
				if(property_exists($this,$k))
				{
					$this->$k = $option;
				}
			}
		}
	}

	protected function run()
	{
		$cache = Cache::instance();
		$this->menuHtml = $cache->get($this->cacheKey);
		if(!$this->menuHtml)
		{
			$this->data = App::$app->getProperty('categories');
			if(!$this->data)
			{
				$this->data = R::getAssoc("SELECT * FROM {$this->table}");
			}
		}
		$this->output();
	}

	protected  function output()
	{
		echo $this->menuHtml;
	}

	protected function getTree()
	{

	}

	protected  function  getMenuHtml($tree, $tab ='')
	{

	}

	protected function catToTemplate($category, $tab='', $id)
	{

	}

}