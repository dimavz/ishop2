<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 19.11.2018
 * Time: 12:28
 */

namespace app\controllers;
use app\models\BreadcrumbsModel;
use app\models\ProductModel;
use \RedBeanPHP\R as R;


class ProductController extends AppController
{
	public function viewAction()
	{
//		debug($this->route);
		$alias = $this->route['alias'];

		$product = R::findOne('product',"publish='1' and alias = ?", [$alias]);

		if(empty($product))
		{
			throw new \Exception("Товар по алиасу $alias не найден", 404);
		}
//		debug($product);
        //Картинки Галлереи товара
		$gallery = R::findAll('gallery',"product_id = ?",[$product->id]);
//		debug($images);

//		debug($product);

		// Хлебные крошки
        $breadcrumbs = BreadcrumbsModel::getBreadcrumbs($product->category_id,$product->title);

		//Связанные товары
//		$related = R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?",[$product->id]);
		$related = R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ? LIMIT 3",[$product->id]);
//				debug($related);
//				exit();

		//Запись в куки текущего товара
        $productModel = new ProductModel();
        $productModel->setRecentlyViewed($product->id);

		//Просмотренные товары из кук
        $viewedProducts = $productModel->getRecentlyViewed();

		//Получить Модификации товара


        // Установка мета данных товара
		$this->setMeta($product->title, $product->description, $product->keywords);

		// Передача данных о товаре в вид
		$this->setData(compact('product','gallery','related','viewedProducts','breadcrumbs'));

	}
}