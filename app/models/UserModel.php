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

}