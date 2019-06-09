<?php

namespace app\models\entities;



class Users extends DataEntity
{
    public $id;
    public $login;
    public $password;


    protected $flags = [
        'id' => false,
        'name' => false,
        'email' => false,
        'login' => false,
        'password' => false,
        'dateCreate' => false,
        'dateChange' => false,
    ];

    public function __construct($login = null, $password = null)
    {
        $this->login = $login;
        $this->password = $password;
    }

}