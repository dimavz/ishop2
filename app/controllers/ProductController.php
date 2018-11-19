<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 19.11.2018
 * Time: 12:28
 */

namespace app\controllers;
use \RedBeanPHP\R as R;


class ProductController extends AppController
{
	public function viewAction()
	{
//		debug($this->route);
		$alias = $this->route['alias'];

		$product = R::findOne('product',"publish='1' and alias = ?", [$alias]);

		if(!$product)
		{
			throw new \Exception("Товар по алиасу $alias не найден", 404);
		}
		//debug($product);
		$gallery = R::findAll('gallery',"product_id = ?",[$product->id]);
//		debug($images);
		$this->setMeta($product->title, $product->description, $product->keywords);
		$this->setData(compact('product','gallery'));

//		debug($product);

		// Хлебные крошки

		//Связанные товары

		//Запись в куки текущего товара

		//Просмотренные товары из кук

		//Галлерея

		//Модификации товара

	}
}