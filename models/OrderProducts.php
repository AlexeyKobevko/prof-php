<?php


namespace app\models;


class OrderProducts extends DbModel
{
    protected $id;
    protected $orderId;
    protected $productId;

    protected $flags = [
        'id' => false,
        'orderId' => false,
        'productId' => false,
    ];

    public function __construct($orderId, $productId)
    {
        parent::__construct();
        $this->orderId = $orderId;
        $this->productId = $productId;
    }

    public static function getTableName()
    {
        return 'orderproducts';
    }

    public function getProps()
    {
        return $arrProps = [
            "id" => $this->id,
            "orderId" => $this->orderId,
            'productId' => $this->productId,
        ];
    }
}