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
		$db = require_once CONFIG.'/config_db.php';
		\R::setup($db['dsn'],$db['user'],$db['pass']);

		if(! \R::testConnection()){
			echo "Соединение не установлено";
			throw new \Exception('Нет соединения с БД'. $db['dsn'], 500);
		}

	}
}