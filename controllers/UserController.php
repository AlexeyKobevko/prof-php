<?php


namespace app\controllers;


use app\models\repositories\UsersRepository;
use app\engine\Request;


class UserController extends Controller
{
    public function actionIndex()
    {

        echo $this->render("login", []);
    }

    public function actionLogout() {
        session_destroy();
        header("Location: /");
        exit();
    }

    public function actionLogin()
    {

        if (isset((new Request())->getParams()['submit'])) {
            $login = $_POST['login'];
            $pass = $_POST['password'];

            if (!(new UsersRepository())->auth($login, $pass)) {
                Die("Не верный пароль!");
            } else

                echo 'URA!!!';
//                header("Location: /");
        }
    }
}