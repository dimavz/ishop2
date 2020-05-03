<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 14.11.2018
 * Time: 12:43
 */

namespace app\controllers;


use ishop\App;
use \RedBeanPHP\R as R;

class CurrencyController extends AppController
{
	public function changeAction()
	{
		$currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
//		debug($currency);
//		exit();
		if($currency)
		{
			$currencies = App::$properties->getProperty('currencies');
			$curr = $currencies[$currency];

//			$curr = R::findOne('currency','code=?',[$currency]);
			if(!empty($curr))
			{
				setcookie('currency',$currency, time()+3600*24*7, '/');
			}
		}
		redirect();
	}
}