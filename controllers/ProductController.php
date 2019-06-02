<?php


namespace app\controllers;

use app\models\entities\Products;
use app\models\repositories\ProductsRepository;


class ProductController extends Controller
{
    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCard() {

        $id = (int)$_GET['id'];
        $product = (new ProductsRepository())->getOne($id);

        echo $this->render("catalog/product", [
            'product' => $product,
        ]);
    }

    public function actionCatalog() {

        $page = (int)$_GET['page'] ?? 0;
        $pagination = 5;
        $from = 0;
        $limit = ($page + 1) * $pagination + $page;
        $products = (new ProductsRepository())->getLimit($from, $limit);
        $page ++;

        echo $this->render('catalog/catalog',[
            'products' => $products,
            'page' => $page
        ]);
    }

    public function actionApiCatalog()
    {
        $page = (int)$_GET['page'] ?? 0;
        $page++;
        $limit = $page * 2;
        $products = Products::getLimit(0, $limit);

        header('Content-Type: application/json');

        echo json_encode([
            'products' => $products,
            'page' => $page
        ], JSON_UNESCAPED_UNICODE);

    }

}