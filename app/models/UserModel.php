<?php
namespace app\models;
use RedBeanPHP\R as R;

class UserModel extends AppModel {

    public function __construct()
    {
        $this->setTable('user');

        $this->attributes = [
            'login' => '',
            'password' => '',
            'name' => '',
            'email' => '',
            'address' => '',
        ];

        $this->rules = [
            'required' => [
                ['login'],
                ['password'],
                ['name'],
                ['email'],
                ['address'],
            ],
            'email' => [
                ['email'],
            ],
            'lengthMin' => [
                ['password', 5],
            ]
        ];
        parent::__construct();
    }

    public function checkUnique(){
        $user = R::findOne('user', 'login = ? OR email = ?', [$this->attributes['login'], $this->attributes['email']]);
        if($user){
            if($user->login == $this->attributes['login']){
                $this->errors['unique'][] = 'Этот логин уже занят';
            }
            if($user->email == $this->attributes['email']){
                $this->errors['unique'][] = 'Этот email уже занят';
            }
            return false;
        }
        return true;
    }

}