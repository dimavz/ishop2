<?php

namespace app\controllers;
use app\models\UserModel;

class UserController extends AppController {

    public function signupAction(){
        if(!empty($_POST)){
            $userModel = new UserModel();
            $data = $_POST;
            $userModel->loadFormData($data);
            debug($userModel);
            die;
        }
        $this->setMeta('Регистрация');
    }

    public function loginAction(){

    }

    public function logoutAction(){

    }

}