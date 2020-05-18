<?php

namespace app\controllers;
use app\models\UserModel;

class UserController extends AppController {

    public function signupAction(){
        if(!empty($_POST)){
            $userModel = new UserModel();
            $data = $_POST;
            $userModel->loadFormData($data);
            if(!$userModel->validate($data) || !$userModel->checkUnique()){
                $userModel->getErrors();
            }else{
                $userModel->attributes['password'] = password_hash($userModel->attributes['password'], PASSWORD_DEFAULT);
                if($userModel->save()){
                    $_SESSION['success'] = 'Пользователь зарегистрирован';
                }else{
                    $userModel->getErrors();
                    $_SESSION['error'] .= 'Ошибка регистрации!';
                }
            }
            redirect();
        }
        $this->setMeta('Регистрация');
    }

    public function loginAction(){

    }

    public function logoutAction(){

    }

}