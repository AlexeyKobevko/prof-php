<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Products;

class ProductsRepository extends Repository
{

    public function getEntityClass()
    {
        return Products::class;
    }
    public function getTableName()
    {
        return 'products';
    }

}