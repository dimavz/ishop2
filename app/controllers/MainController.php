<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 30.10.2018
 * Time: 17:44
 */

namespace app\controllers;

use ishop\App;
use \RedBeanPHP\R as R;

class MainController extends AppController
{
	public function indexAction()
	{
		$posts = R::findAll('test');
//		$post_one = R::findOne('test', 'id=?', '2');
		$logs = R::getDatabaseAdapter()->getDatabase()->getLogger();
//		debug($posts);
		$this->setMeta(App::$app->getProperty('shop_name'), 'Главная страница интернет магазина ishop2','электроника,бытовая техника, компьютеры и периферия');
//		$this->setData(['name'=>'Dmitry','age'=>45]);
//		Можно сделать по другому
		$name = 'Дмитрий';
		$age = 45;
		$workers =['Андрей','Николай','Юрий'];
		$this->setData(compact('name','age','workers','posts','logs','post_one'));
	}
}