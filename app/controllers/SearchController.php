<?php

namespace app\controllers;
use \RedBeanPHP\R as R;

class SearchController extends AppController
{
    public function typeaheadAction()
    {
        if ($this->isAjax()) {
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if(!empty($query))
            {
                $products = R::getAll('SELECT id, title FROM product WHERE title LIKE ? LIMIT 11',["%{$query}%"]);
                echo json_encode($products);
            }
        }
        die;
    }

    public function indexAction(){
        $query = !empty(trim($_GET['find'])) ? trim($_GET['find']) : null;
        if($query){
            $products = R::find('product', "title LIKE ?", ["%{$query}%"]);
            $this->setMeta('Поиск по: ' . h($query));
            $this->setData(compact('products', 'query'));
        }
    }
}