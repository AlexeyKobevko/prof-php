<?php


namespace app\models;


class Basket extends DbModel
{
    protected $id;
    protected $userId;
    protected $productId;
    protected $amount;

    protected $flags = [
        'id' => false,
        'userId' => false,
        'productId' => false,
        'amount' => false,
    ];

    public function __construct($userId, $productId, $amount)
    {
        parent::__construct();
        $this->userId = $userId;
        $this->productId = $productId;
        $this->amount = $amount;
    }

    public static function getTableName()
    {
        return 'baskets';
    }

    public function getProps()
    {
        return $arrProps = [
            "id" => $this->id,
            "userId" => $this->userId,
            'productId' => $this->productId,
            'amount' => $this->amount,
        ];
    }
}