<?php

namespace app\models;
use RedBeanPHP\R as R;

class ProductModel extends AppModel
{
    public function setRecentlyViewed($id){
        $recentlyViewed = $this->getAllRecentlyViewed();
        if (empty($recentlyViewed))
        {
            setcookie('recentlyViewed',$id,time()+3600*24,'/');
        }
        else{
            $recentlyViewed = explode(',',$recentlyViewed);
//            debug($recentlyViewed);
            if(!in_array($id,$recentlyViewed))
            {
                array_push($recentlyViewed,$id);
                //            debug($recentlyViewed);
                $recentlyViewed = implode(',',$recentlyViewed);
//                            debug($recentlyViewed);
                setcookie('recentlyViewed',$recentlyViewed,time()+3600*24,'/');
            }
        }
    }

    public function getRecentlyViewed(){
        $products = null;
        $recentlyViewed = $this->getAllRecentlyViewed();
        if(!empty($recentlyViewed))
        {
            $recentlyViewed = explode(',',$recentlyViewed); // Преобразуем строку в массив
//            debug($recentlyViewed);
            $recentlyViewed = array_reverse($recentlyViewed); // Делаем реверс массива, что бы последние просмотренные товары стали первыми
//            debug($recentlyViewed);
            $recentlyViewed = implode(',',$recentlyViewed); // записываем массив в строку
//            debug($recentlyViewed);
            $products = R::find('product','id IN('.$recentlyViewed.') LIMIT 3'); // выбираем из БД 3 товара
        }
//        debug($products);
        return $products;
    }

    public function getAllRecentlyViewed(){
        if(isset($_COOKIE['recentlyViewed']) && !empty($_COOKIE['recentlyViewed']))
        {
            return $_COOKIE['recentlyViewed'];
        }
        return null;
    }

    public function getModificationProduct($id){
        $mods = R::find('modification','product_id = ?',[$id]); // выбираем из БД 3 товара
        return $mods;
    }

}