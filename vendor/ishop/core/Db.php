<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.11.2018
 * Time: 16:26
 */

namespace ishop;


class Db
{
	use TSingletone;

	protected function __construct()
	{
		$db = require_once CONFIG.'/config_db.php';
	}
}