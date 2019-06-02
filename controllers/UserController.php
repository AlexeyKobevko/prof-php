<?php


namespace app\controllers;


use app\engine\Db;
use app\models\Users;

class UserController extends Controller
{
    public function actionIndex() {
        $users = Users::getAll();

        echo $this->render("users", [
            'users' => $users
        ]);
    }
}