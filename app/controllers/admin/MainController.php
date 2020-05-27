<?php

namespace app\controllers\admin;
use \RedBeanPHP\R as R;

class MainController extends AppController
{

    public function indexAction()
    {
        $this->setMeta('Панель управления администратора');
    }

}