<?php


namespace app\controllers;

use app\models\Products;


class ProductController extends Controller
{
    protected $template = 'catalog/catalog.twig';

    public function actionIndex() {
        echo $this->renderTwig($this->template);
    }

    public function actionCard() {

        $id = $_GET['id'];

        $product = Products::getOne($id);
        echo $this->render("card", [
            'product' => $product,
        ]);
    }

    public function actionCatalog() {

        $page = (int)$_GET['page'] ?? 0;
        $pagination = 5;
        $from = 0;
        $limit = ($page + 1) * $pagination + $page;
        $products = Products::getLimit($from, $limit);
//        $page++;

//        echo $this->render("catalog", [
//            'products' => $products,
//            'page' => $page,
//        ]);
        echo $this->renderTwig(['products' => $products, 'page' => $page]);
    }

}