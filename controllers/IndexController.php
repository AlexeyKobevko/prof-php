<?php


namespace app\controllers;


class IndexController extends Controller
{
    protected $template = 'index.twig';

    public function actionIndex($data = []) {

        echo $this->renderTwig();
    }

}