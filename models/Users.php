<?php

namespace app\models;


class Users extends Model
{
    public $id;
    public $name;
    public $email;
    public $login;
    public $password;
    public $dateCreate;

    public function __construct()
    {
        parent::__construct();
    }

    public function getTableName()
    {
        return 'users';
    }



}