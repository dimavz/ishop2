<?php

namespace app\models;

use ishop\App;
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
            return $orderID;
        }
        $_SESSION['error'] = 'Ошибка сохранения товаров в заказе!';
        return false;
    }

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
//        $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
        $server = App::$properties->getProperty('smtp_server');
        $port = App::$properties->getProperty('smtp_port');
        $protocol = App::$properties->getProperty('smtp_protocol');
        $login = App::$properties->getProperty('smtp_login');
        $password = App::$properties->getProperty('smtp_password');
        $shop_name = App::$properties->getProperty('shop_name');
        $admin_email = App::$properties->getProperty('admin_email');

        $transport = (new Swift_SmtpTransport($server, $port, $protocol))
            ->setUsername($login)
            ->setPassword($password);
//
//$transport = (new Swift_SmtpTransport('smtp.example.org', 25))
//            ->setUsername('your username')
//            ->setPassword('your password');

// Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

// Create a message
        ob_start();
        require APP . '/views/Mail/mail_order.php';
        $body = ob_get_clean();

        //        $message = (new Swift_Message("Сделан заказ №{$orderID}"))
//            ->setFrom(['d.zatulenko@yandex.ru' => 'Дмитрий'])
//            ->setTo(['zatulenko@gmail.com' =>'Дмитрий Затуленко'])
//            ->setBody($body,'text/html');

        $message_client = (new Swift_Message("Вы совершили заказ №{$orderID} на сайте " . $shop_name))
            ->setFrom([$login => $shop_name])
            ->setTo($user_email)
            ->setBody($body, 'text/html');

        $message_admin = (new Swift_Message("Сделан заказ №{$orderID}"))
            ->setFrom([$login => $shop_name])
            ->setTo($admin_email)
            ->setBody($body, 'text/html');

// Send the message
        $mailer->send($message_client);
        $result = $mailer->send($message_admin);
        return $result;
    }

}