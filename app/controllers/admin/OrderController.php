<?php

namespace app\controllers\admin;


use ishop\App;
use ishop\libs\Pagination;
use RedBeanPHP\R;

class OrderController extends AppController {

    public function indexAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = App::$properties->getProperty('pagination')? App::$properties->getProperty('pagination'):5;
        $count = R::count('order');
        $pagination = new Pagination($page, $limit, $count);
        $start = $pagination->getStart();

        $orders = R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`, `order`.`date`, `order`.`update_at`, `order`.`currency`, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
  JOIN `user` ON `order`.`user_id` = `user`.`id`
  JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
  GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $limit");

        $this->setMeta('Список заказов');
        $this->setData(compact('orders', 'pagination', 'count'));
    }

    public function viewAction(){
        $order_id = $this->getRequestID();
        $order = R::getRow("SELECT `order`.*, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
  JOIN `user` ON `order`.`user_id` = `user`.`id`
  JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
  WHERE `order`.`id` = ?
  GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$order_id]);
        if(!$order){
            throw new \Exception('Страница не найдена', 404);
        }
        $order_products = R::findAll('order_product', "order_id = ?", [$order_id]);
        $this->setMeta("Заказ №{$order_id}");
        $this->setData(compact('order', 'order_products'));
    }

}