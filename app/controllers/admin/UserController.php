<?php

namespace app\controllers\admin;

use app\models\UserModel;

class UserController extends AppController {

    public function loginAdminAction(){
        if(!empty($_POST)){
            $user = new UserModel();
            if($user->login(true)){
                $_SESSION['success'] = 'Вы успешно авторизованы';
            }else{
                $_SESSION['error'] = 'Логин/пароль введены неверно';
            }
            if(UserModel::isAdmin()){
                redirect(ADMIN);
            }else{
                redirect();
            }
        }
        $this->layout = 'login';
    }

    public function logoutAction(){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect(PATH);
    }
}