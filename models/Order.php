<?php


namespace app\models;


class Order extends Model
{
    public $id;
    public $userId;
    public $address;
    public $dateCreate;
    public $dateChange;
    public $status;

    public function getTableName()
    {
        return 'orders';
    }
}