<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.11.2018
 * Time: 16:26
 */

namespace ishop;

use \RedBeanPHP\R as R;

class Db
{
	use TSingletone;

	protected function __construct()
	{
		$config = require_once CONFIG . '/config_db.php';
//		\R::setup($db['dsn'],$db['user'],$db['pass']);
		R::setup($config['dsn'], $config['user'], $config['pass']);

		if (!R::testConnection())
		{
//			Соединение не установлено
			throw new \Exception('Нет соединения с БД' . $config['dsn'], 500);
		}
		else
		{
//			echo 'Соединение установлено';
		}

		if (DEBUG) //Если включен режим отладки
		{
			R::debug(true, 1);
		}
		else
		{
			R::freeze(true); // Замораживаем создание объектов в БД при продакшен режиме
		}

	}
}