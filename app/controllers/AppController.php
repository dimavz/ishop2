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

class AppController extends Controller
{
		public function __construct($route)
		{
			parent::__construct($route);
			new AppModel();
//			setcookie('currency','EUR', time()+3600*24*7, '/');
			$currencies = Currency::getCurrencies();
			App::$app->setProperty('currencies',$currencies);
			$currency = Currency::getCurrency(App::$app->getProperty('currencies'));
			App::$app->setProperty('currency',$currency);
//			debug(App::$app->getProperties());

		}
}