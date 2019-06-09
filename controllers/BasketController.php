<?php


namespace app\controllers;

use app\models\entities\Basket;
use app\engine\Request;
use app\models\repositories\BasketRepository;


class BasketController extends Controller
{
    public function actionIndex() {
        echo $this->render('basket', [
            'products' => (new BasketRepository())->getBasket(session_id())
        ]);
    }

    public function actionAddBasket() {

        (new Basket(null, session_id(), (new Request())->getParams()['id']))->save();

        $count = (new BasketRepository())->getCountWhere('session_id', session_id());
        $response = ['count' => $count];

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionDelete() {

        $id = (new Request())->getParams()['id'];
        $basket = (new BasketRepository())->getOne($id);
        if (session_id() == $basket->session_id) {
            (new BasketRepository())->delete($basket);
            $count = (new BasketRepository())->getCountWhere('session_id', session_id());
            echo json_encode(['response' => 1, 'count' => $count]);
        } else
        {
            echo json_encode(['response' => 0]);
        }

    }
}