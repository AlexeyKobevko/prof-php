<?php


namespace app\controllers;

use app\models\Products;


class ProductController extends Controller
{
    protected $action;
    protected $layout = "main";
    protected $useLayout = true;

    public function runAction($action = null) {
        $this->action = $action ?: 'catalog';
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }

    public function actionCard() {

        $id = $_GET['id'];

        $product = Products::getOne($id);
        echo $this->render("card", [
            'product' => $product,
        ]);
    }

    public function actionCatalog() {

        $products = Products::getAll();
        $result = '';

        foreach ($products as $product) {
            $name = $product['name'];
            $imgPath = $product['imgPath'];
            $description = $product['description'];
            $price = $product['price'];
            $id = $product['id'];

            $result .= $this->renderTemplate("singleProduct", [
                'name' => $name,
                'imgPath' => $imgPath,
                'description' => $description,
                'price' => $price,
                'id' => $id,
            ]);
        }

        echo $this->render("catalog", [
            'content' => $result,
        ]);
    }

}