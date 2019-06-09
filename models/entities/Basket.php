<?php


namespace app\models\entities;


class Basket extends DataEntity
{
    protected $properties = [
        'id' => null,
        'session_id' => null,
        'product_id' => null,
    ];

    protected $flags = [
        'id' => false,
        'session_id' => false,
        'product_id' => false,
    ];

    public function __construct($session = null, $product = null)
    {
        $this->properties['session_id'] = $session;
        $this->properties['product_id'] = $product;
    }


}