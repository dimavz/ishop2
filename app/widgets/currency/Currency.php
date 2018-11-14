<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 14.11.2018
 * Time: 10:34
 */

namespace app\widgets\currency;

use ishop\App;
use \RedBeanPHP\R as R;

class Currency
{
	protected $tpl; //Свойство шаблона выпадающего списка
	protected $currencies; //Свойство для записи всех доступных валют
	protected $currency; //Свойство для хранения активной для пользователя валюты

	public function __construct()
	{
		$this->tpl = __DIR__ . '/template/currency_tpl.php';
		$this->run();
	}

	protected function run() // Получает список доступных валют и текущую валюту
	{
		$this->currencies = App::$app->getProperty('currencies');
		$this->currency = App::$app->getProperty('currency');
		echo $this->getHtml();
	}

	public static function getCurrencies()
	{
		return R::getAssoc("SELECT code,title,symbol_left,symbol_right,value,base FROM currency ORDER BY base DESC");
	}

	public static function getCurrency($currencies)
	{
		$key = key($currencies);
//		debug($currencies);
		if (isset($_COOKIE['currency']) && array_key_exists($_COOKIE['currency'], $currencies))
		{
			$key = $_COOKIE['currency'];
		}
		else
		{
			foreach ($currencies as $k=>$curr)
			{
				if($curr['base'] == 1)
				{
					$key = $k;
				}
			}
		}
		$currency = $currencies[$key];
		$currency['code'] = $key;
		return $currency;
	}

	protected function getHtml() // Метод для формирования HTML разметки
	{
		ob_start();
		require_once $this->tpl;
		return ob_get_clean();
	}

}