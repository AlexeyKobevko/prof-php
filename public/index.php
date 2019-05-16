<?php


use app\models\{ Products };
use app\engine\{ Autoload, Db };


include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);


$product = new Products(new Db());
$user = new \app\models\Users(new Db());

var_dump($product);
var_dump($user);

var_dump($product->getOne(1));

var_dump($product instanceof Products);