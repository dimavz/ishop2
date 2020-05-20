<?php

namespace app\models;

use RedBeanPHP\R;

class OrderModel extends AppModel
{
    public function __construct()
    {
        $this->setTable('order');

        $this->attributes = [
            'user_id' => '',
            'note' => '',
            'currency' => '',
            ];

        parent::__construct();
    }

//    public static function saveOrder($data)
//    {
//        $orderID = null;
//        $order = R::dispense('order');
//        $order->user_id = $data['user_id'];
//        $order->note = $data['note'];
//        $order->currency = $_SESSION['cart.currency']['code'];
//        $orderID = R::store($order);
//        self::saveOrderProduct($orderID);
//        return $orderID;
//    }

    public function saveOrderProduct($orderID)
    {
        debug($_SESSION['cart']);
        die;
            return true;
    }

    public function mailOrder($orderID, $user_email)
    {

    }

}