<?php


namespace app\models\repositories;


use app\models\entities\Users;
use app\models\Repository;

class UsersRepository extends Repository
{

    public function auth($login, $pass) {
        $user = $this->getOneWhere('login', $login);
        if ($pass == $user->pass) {
            $_SESSION['login'] = $login;
            return true;
        }
        return false;
    }

    public function isAuth() {
        return isset($_SESSION['login']) ? true : false;
    }

    public function getName() {
        return $this->isAuth() ? $_SESSION['login'] : "Guest";
    }

    public function getTableName()
    {
        return 'users';
    }

    public function getEntityClass()
    {
        return Users::class;
    }

}