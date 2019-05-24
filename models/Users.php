<?php

namespace app\models;


class Users extends DbModel
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
        parent::__construct();
        $this->name = $name;
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
    }

    public static function getTableName()
    {
        return 'users';
    }

    public function getProps()
    {
        return $arrProps = [
            "id" => $this->id,
            "name" => $this->name,
            'email' => $this->email,
            'login' => $this->login,
            'password' => $this->password,
            'dateCreate' => $this->dateCreate,
            'dateChange' => $this->dateChange,
        ];
    }


}