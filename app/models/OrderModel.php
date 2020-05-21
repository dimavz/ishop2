<?php

namespace app\models;

use RedBeanPHP\R;
use Swift_Mailer;
use Swift_Message;
use Swift_SendmailTransport;
use Swift_SmtpTransport;

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

    public function save($table = '')
    {
        $orderID = parent::save($table);
        if ($this->saveOrderProduct($orderID)) {
            $cartModel = new CartModel();
            $cartModel->clearAll();
//            unset($_SESSION['cart']);
//            unset($_SESSION['cart.qty']);
//            unset($_SESSION['cart.sum']);
            return $orderID;
        }
        $_SESSION['error'] = 'Ошибка сохранения товаров в заказе!';
        return false;
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
        $sql_part = '';
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $parts = explode('-', $product_id);
            $modification_id = 0;
            if (isset($parts[1])) {
                $product_id = (int)$parts[0];
                $modification_id = (int)$parts[1];
            }
            $sql_part .= "($orderID, $product_id, $modification_id, {$product['qty']}, '{$product['title']}', {$product['price']}),";
        }
        $sql_part = rtrim($sql_part, ','); // Удаляет лишнюю запятую из сформированной строки с товарами
        return R::exec("INSERT INTO order_product (order_id, product_id, modification_id, qty, title, price) VALUES $sql_part");
    }

    public function mailOrder($orderID, $user_email)
    {
        // Create the Transport
        $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');

//        $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
//            ->setUsername('your username')
//            ->setPassword('your password');

// Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

// Create a message
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['john@doe.com' => 'John Doe'])
            ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
            ->setBody('Here is the message itself');

// Send the message
        $result = $mailer->send($message);
    }

}