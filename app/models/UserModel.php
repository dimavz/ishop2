<?php
namespace app\models;

class UserModel extends AppModel {

    public function __construct()
    {
        $this->attributes = [
            'login' => '',
            'password' => '',
            'name' => '',
            'email' => '',
            'address' => '',
        ];
        parent::__construct();
    }

}