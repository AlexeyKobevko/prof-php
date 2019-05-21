<?php


use app\models\{ Products, Users };
use app\engine\Autoload;


include "../engine/Autoload.php";
include "../config/main.php";

spl_autoload_register([new Autoload(), 'loadClass']);


$product = new Products('Плюшки', 'В лучших традициях Фрёкен Бок', 252, 1);

$product->insert();
