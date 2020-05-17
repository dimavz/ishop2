<?php

namespace app\controllers;
use app\models\UserModel;

class UserController extends AppController {

    public function signupAction(){
        if(!empty($_POST)){
            $userModel = new UserModel();
            $data = $_POST;
            $userModel->loadFormData($data);
            if(!$userModel->validate($data)){
//                echo "NO";
//                die;
                $userModel->getErrors();
                redirect();
            }else{
//                echo "YES";
//                die;
                $_SESSION['success'] = 'OK';
                redirect();
            }
        }
        $this->setMeta('Регистрация');
    }

    public function loginAction(){

    }

    public function logoutAction(){

    }

}