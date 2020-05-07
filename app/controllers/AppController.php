<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 01.11.2018
 * Time: 14:38
 */

namespace app\controllers;


use app\models\AppModel;
use app\widgets\currency\Currency;
use ishop\App;
use ishop\base\Controller;
use ishop\Cache;
use \RedBeanPHP\R as R;

class AppController extends Controller
{
		public function __construct($route)
		{
			parent::__construct($route);
			new AppModel();
//			setcookie('currency','EUR', time()+3600*24*7, '/');
			$currencies = Currency::getCurrencies();
//			debug($currencies);
			App::$properties->setProperty('currencies',$currencies);
			$currency = Currency::getCurrency(App::$properties->getProperty('currencies'));
			App::$properties->setProperty('currency',$currency);
//			debug(App::$app->getProperties());
			App::$properties->setProperty('categories', self::cacheCategories());
//			debug(App::$app->getProperties());

		}

		public static function cacheCategories()
		{
			$cache = Cache::getInstance();
			$categories = $cache->get('categories');
			if(!$categories)
			{
				$categories = R::getAssoc("SELECT * FROM category");
				$cache->set('categories',$categories);
			}
			return $categories;
		}
}