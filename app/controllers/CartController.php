<?php


namespace app\controllers;

use app\models\CartModel;
use app\models\OrderModel;
use app\models\UserModel;
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

    public function viewAction(){
        $this->setMeta('Корзина');
    }

    public function checkoutAction(){
        if(!empty($_POST)){
            // регистрация пользователя
            if(!UserModel::checkAuth()){
                $userModel = new UserModel();
                $data = $_POST;
                $userModel->loadFormData($data);
                if(!$userModel->validate($data) || !$userModel->checkUnique()){
                    $userModel->getErrors();
                    $_SESSION['singup_form_data'] = $data;
                    redirect();
                }else{
                    $userModel->attributes['password'] = password_hash($userModel->attributes['password'], PASSWORD_DEFAULT);
                    $user_id = null;
                    if(!$user_id = $userModel->save('user')){
                        $_SESSION['error'] = 'Ошибка!';
                        redirect();
                    }
                    else{
                        $_SESSION['user']['id'] = $user_id;
                        foreach ($userModel->attributes as $k=>$v)
                        {
                            if($k != 'password')
                            {
                                $_SESSION['user'][$k] = $v;
                            }
                        }
                    }
                }
            }

            // сохранение заказа
            $data['user_id'] = isset($user_id) ? $user_id : $_SESSION['user']['id'];
            $data['note'] = !empty($_POST['note']) ? $_POST['note'] : '';
            $data['currency'] = $_SESSION['cart.currency']['code'];
            $orderModel = new OrderModel();
            $orderModel->loadFormData($data);
            if($order_id = $orderModel->save()){
                $user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : $_POST['email'];
                $orderModel->mailOrder($order_id, $user_email);
            }
        }
        redirect();
    }

}