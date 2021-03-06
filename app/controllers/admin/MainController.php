<?php

namespace app\controllers\admin;
use \RedBeanPHP\R as R;

class MainController extends AppController
{

    public function indexAction()
    {
        $countNewOrders = R::count('order', "status = '0'");
        $countUsers = R::count('user');
        $countProducts = R::count('product');
        $countCategories = R::count('category');
        $this->setMeta('Панель управления');
        $this->setData(compact('countNewOrders', 'countCategories', 'countProducts', 'countUsers'));
    }

}