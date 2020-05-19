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
                $_SESSION['singup_form_data'] = $data;
            }else{
                $userModel->attributes['password'] = password_hash($userModel->attributes['password'], PASSWORD_DEFAULT);
                $user_id = null;
                if($user_id = $userModel->save()){
                    $_SESSION['user']['id'] = $user_id;
                    foreach ($userModel->attributes as $k=>$v)
                    {
                        if($k != 'password')
                        {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    $_SESSION['success'] = 'Пользователь зарегистрирован';
                    redirect(PATH.'/user/profile');
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
        if(!empty($_POST)){
            $userModel = new UserModel();
            if($userModel->login()){
                $_SESSION['success'] = 'Вы успешно авторизованы';
            }else{
                $_SESSION['error'] = 'Логин/пароль введены неверно';
            }
            redirect(PATH.'/user/profile');
        }
        $this->setMeta('Вход');
    }

    public function profileAction(){
        $this->setMeta('Профиль пользователя');
    }

    public function logoutAction(){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect(PATH);
    }

}