<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\UserModel;
use ishop\base\Controller;

class AppController extends Controller {

    public $layout = 'admin';

    public function __construct($route){
        parent::__construct($route);
        if(!UserModel::isAdmin() && $route['action'] != 'login-admin'){
            redirect(ADMIN . '/user/login-admin'); // UserController::loginAdminAction
        }
        new AppModel();
    }

}