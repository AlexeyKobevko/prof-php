<?php

namespace app\models\entities;



class Users extends DataEntity
{
    protected $id;
    protected $name;
    protected $email;
    protected $login;
    protected $password;
    protected $dateCreate;
    protected $dateChange;

    protected $flags = [
        'id' => false,
        'name' => false,
        'email' => false,
        'login' => false,
        'password' => false,
        'dateCreate' => false,
        'dateChange' => false,
    ];

    public function __construct($name = null, $email = null, $login = null, $password = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
    }

}