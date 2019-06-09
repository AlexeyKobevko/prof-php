<?php


namespace app\controllers;


use app\models\repositories\UsersRepository;


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
        //Авторизуем пользователя
        //Переделать на Request !!!!
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];

            if (!(new UsersRepository())->auth($login, $pass)) {
                Die("Не верный пароль!");
            } else
                header("Location: /");
        }
    }
}