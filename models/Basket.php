<?php


namespace app\models;


class Basket extends Model
{
    public $id;
    public $userId;
    public $productId;
    public $amount;

    public function getTableName()
    {
        return 'baskets';
    }
}