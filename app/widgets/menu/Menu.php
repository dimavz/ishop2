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
use RedUNIT\Base\Threeway;

class Menu
{
	protected $data; // Свойство для данных
	protected $tree; // Свойство для построения дерева меню из данных
	protected $menuHtml; // Свойство для хранения готового Html кода меню
	protected $tpl; // Свойство для хранения шаблона меню
	protected $container = 'ul'; // Свойство для хранения тэга контейнера меню
	protected $class = 'menu';
	protected $table = 'category'; // Свойство для хранения таблицы из которой выбираются данные для меню
	protected $cache = 3600; // Свойство для хранения времени жизни кэша данных меню
	protected $cacheKey = 'ishop_menu'; // Свойство для хранения ключа кэша
	protected $attrs = []; // Свойство для хранения атрибутов меню
	protected $prepend = ''; // Свойство для хранения префикса

	public function __construct($options = [])
	{
		$this->tpl = __DIR__ . '/tmpl/default.php';
		$this->getOptions($options);
		$this->run();
	}

	protected function getOptions($options)
	{
		if (is_array($options))
		{
			foreach ($options as $k => $option)
			{
				if (property_exists($this, $k))
				{
					$this->$k = $option;
				}
			}
		}
	}

	protected function run()
	{
		$cache          = Cache::getInstance();
		$this->menuHtml = $cache->get($this->cacheKey);
		if (!$this->menuHtml)
		{
			$this->data = App::$properties->getProperty('categories');
			if (!$this->data)
			{
				$this->data = R::getAssoc("SELECT * FROM {$this->table}");
			}
			$this->tree = $this->getTree();
//			debug($this->tree);
			$this->menuHtml = $this->getMenuHtml($this->tree);
			if ($this->cache)
			{
				$cache->set($this->cacheKey, $this->menuHtml, $this->cache);
			}
		}
		$this->output();
	}

	protected function output()
	{
		$attrs = '';
		if (!empty($this->attrs))
		{
			foreach ($this->attrs as $k =>$v)
			{
				$attrs .= " $k='$v' ";
			}
		}
		echo "<{$this->container} class='{$this->class}'  $attrs >";
		echo $this->prepend;
		echo $this->menuHtml;
		echo "</{$this->container}>";
	}

	protected function getTree()
	{
		$tree = [];
		$data = $this->data;
		foreach ($data as $id => &$node)
		{
			if (!$node['parent_id'])
			{
				$tree[$id] = &$node;
			}
			else
			{
				$data[$node['parent_id']]['childs'][$id] = &$node;
			}
		}

		return $tree;
	}

	protected function getMenuHtml($tree, $tab = '')
	{
		$str = '';
		foreach ($tree as $id => $category)
		{
			$str .= $this->catToTemplate($category, $tab, $id);
		}

		return $str;
	}

	protected function catToTemplate($category, $tab = '', $id)
	{
		ob_start();
		require $this->tpl;

		return ob_get_clean();
	}

}