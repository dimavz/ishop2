<?php


namespace app\models;
/*Array
(
    [1] => Array
        (
            [qty] => QTY
            [name] => NAME
            [price] => PRICE
            [img] => IMG
        )
    [10] => Array
        (
            [qty] => QTY
            [name] => NAME
            [price] => PRICE
            [img] => IMG
        )
    )
    [qty] => QTY,
    [sum] => SUM
*/


use ishop\App;

class CartModel extends AppModel
{
    public function addToCart($product, $qty = 1, $mod = null){

        if(!isset($_SESSION['cart.currency'])){
            $_SESSION['cart.currency'] = App::$properties->getProperty('currency');
        }

        if($mod){
            $ID = "{$product->id}-{$mod->id}";
            $title = "{$product->title} ({$mod->title})";
            $price = $mod->price;
        }else{
            $ID = $product->id;
            $title = $product->title;
            $price = $product->price;
        }
//        debug($_SESSION);
//        debug($ID);
//        debug($title);
//        debug($price);

        if(isset($_SESSION['cart'][$ID])){
            $_SESSION['cart'][$ID]['qty'] += $qty;
        }else{
            $_SESSION['cart'][$ID] = [
                'qty' => $qty,
                'title' => $title,
                'alias' => $product->alias,
                'price' => $price * $_SESSION['cart.currency']['value'],
                'img' => $product->img,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * ($price * $_SESSION['cart.currency']['value']) : $qty * ($price * $_SESSION['cart.currency']['value']);
    }

    public function deleteItem($id){
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);
    }

    public function clearAll(){
//        debug($_SESSION);
        unset($_SESSION['cart.currency']);
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
    }

    public static function recalc($curr){
//        debug($curr);
//        debug($_SESSION);
//        die;
        if(isset($_SESSION['cart.currency'])){
            if($_SESSION['cart.currency']['base']){
//                $_SESSION['cart.sum'] *= $curr->value;
                $_SESSION['cart.sum'] *= $curr['value'];
            }else{
//                $_SESSION['cart.sum'] = $_SESSION['cart.sum'] / $_SESSION['cart.currency']['value'] * $curr->value;
                $_SESSION['cart.sum'] = $_SESSION['cart.sum'] / $_SESSION['cart.currency']['value'] * $curr['value'];
            }
            if(isset($_SESSION['cart'])&& !empty($_SESSION['cart']))
            {
                foreach($_SESSION['cart'] as $k => $v){
                    if($_SESSION['cart.currency']['base']){
//                    $_SESSION['cart'][$k]['price'] *= $curr->value;
                        $_SESSION['cart'][$k]['price'] *= $curr['value'];
                    }else{
//                    $_SESSION['cart'][$k]['price'] = $_SESSION['cart'][$k]['price'] / $_SESSION['cart.currency']['value'] * $curr->value;
                        $_SESSION['cart'][$k]['price'] = $_SESSION['cart'][$k]['price'] / $_SESSION['cart.currency']['value'] * $curr['value'];
                    }
                }
            }
            foreach($curr as $k => $v){
                $_SESSION['cart.currency'][$k] = $v;
            }
        }
    }
}