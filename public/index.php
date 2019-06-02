<?php
session_start();

include "../engine/Autoload.php";
include "../config/main.php";
require_once '../vendor/autoload.php';


use app\models\entities\Products;
use app\engine\Autoload;
use app\engine\TwigRender;
use app\engine\Request;



spl_autoload_register([new Autoload(), 'loadClass']);

$request = new Request();

$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass= "app\\controllers\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender());
    $controller->runAction($actionName);
}

/** @var Products $product */

//$product = Products::getOne(8);
//$product->__set('price', 115);
//var_dump($product);

//$product->update();
//var_dump($product);
//$product = new Products('Щи', 'Ешь щи, а не получай по ним', 48.95, 1);

//$product = Products::getOne(3);
//$product->__set('price', 108);
//$product->__set('imgPath', 'img/placeholder.png');
//$product->save();
//var_dump($product);
//$product->delete();

// $product = new Products('Плюшки', 'В лучших традициях Фрёкен Бок', 252, 1);