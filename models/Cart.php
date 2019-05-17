<?php


namespace app\models;


class Cart extends Model
{
    public $id;
    public $userId;
    public $productId;
    public $amount;

    public function getTableName()
    {
        return 'cart';
    }
}