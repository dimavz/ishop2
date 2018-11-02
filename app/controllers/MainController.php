<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 30.10.2018
 * Time: 17:44
 */

namespace app\controllers;

use ishop\App;

class MainController extends AppController
{
	public function indexAction()
	{
//		echo "Работает метод indexAction()";
		$this->setMeta(App::$app->getProperty('shop_name'), 'Главная страница интернет магазина ishop2','электроника,бытовая техника, компьютеры и периферия');
//		$this->setData(['name'=>'Dmitry','age'=>45]);
//		Можно сделать по другому
		$name = 'Дмитрий';
		$age = 45;
		$workers =['Андрей','Николай','Юрий'];
		$this->setData(compact('name','age','workers'));
	}
}