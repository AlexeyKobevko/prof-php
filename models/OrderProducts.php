<?php


namespace app\models;


class OrderProducts extends Model
{
    public $id;
    public $orderId;
    public $productId;

    public function getTableName()
    {
        return 'orderproducts';
    }
}