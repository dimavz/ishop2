<?php


namespace app\controllers;

use app\models\CartModel;
use RedBeanPHP\R as R;


class CartController extends AppController
{
    public function addAction()
    {
//        debug($_GET);
//        die;
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $mod_id = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;
        $product = null;
        if ($id) {
            $product = R::findOne('product', 'id = ?', [$id]);
            if (!$product) {
                return false;
            }
//           debug($product);
            if ($mod_id) {
                $mod = R::findOne('modification', 'id = ? AND product_id = ?', [$mod_id, $id]);
//                debug($mod);
            }

        }
        $cartModel = new CartModel();
        $cartModel->addToCart($product,$qty,$mod);
        if($this->isAjax())
        {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function showAction(){
        $this->loadView('cart_modal');
    }

    public function deleteAction(){
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if(isset($_SESSION['cart'][$id])){
            $cartModel = new CartModel();
            $cartModel->deleteItem($id);
        }
        if($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }
    public function clearAction(){
        if(isset($_SESSION['cart'])){
            $cartModel = new CartModel();
            $cartModel->clearAll();
        }
        if($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }

}