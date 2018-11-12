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
		$this->setMeta(App::$app->getProperty('shop_name'),
			'Главная страница интернет магазина ishop2',
			'электроника,бытовая техника, компьютеры и периферия');
	}
}