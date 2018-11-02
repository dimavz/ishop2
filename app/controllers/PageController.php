<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 30.10.2018
 * Time: 17:48
 */

namespace app\controllers;


class PageController extends AppController
{
	public function viewAction()
	{
		echo "Работает метод: ". __METHOD__;
	}
}