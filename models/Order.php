<?php


namespace app\models;


class Order extends Model
{
    public $id;
    public $userId;
    public $address;
    public $dateCreate;
    public $status;

    public function getTableName()
    {
        return 'order';
    }
}