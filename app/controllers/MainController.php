<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 30.10.2018
 * Time: 17:44
 */

namespace app\controllers;

use ishop\App;
use ishop\Cache;
use \RedBeanPHP\R as R;

class MainController extends AppController
{
	public function indexAction()
	{
		$this->setMeta(App::$properties->getProperty('shop_name'),
			'Главная страница интернет магазина ishop2',
			'электроника,бытовая техника, компьютеры и периферия');
		$brands = R::find('brand', 'LIMIT 3');
		$hits = R::find('product', "hit='1' AND publish ='1' LIMIT 8");
//		debug($hits);
		$this->setData(compact('brands','hits'));
	}
}