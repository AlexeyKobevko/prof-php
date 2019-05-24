<?php


namespace app\models;


class Order extends DbModel
{
    protected $id;
    protected $userId;
    protected $address;
    protected $dateCreate;
    protected $dateChange;
    protected $status;

    protected $flags = [
        'id' => false,
        'userId' => false,
        'address' => false,
        'dateCreate' => false,
        'dateChange' => false,
        'status' => false,
    ];

    public function __construct($userId, $address)
    {
        parent::__construct();
        $this->userId = $userId;
        $this->address = $address;
    }

    public static function getTableName()
    {
        return 'orders';
    }

    public function getProps()
    {
        return $arrProps = [
            "id" => $this->id,
            "userId" => $this->userId,
            'address' => $this->address,
            'dateCreate' => $this->dateCreate,
            'dateChange' => $this->dateChange,
            'status' => $this->status,
        ];
    }
}