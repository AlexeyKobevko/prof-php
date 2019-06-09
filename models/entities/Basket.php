<?php


namespace app\models\entities;


class Basket extends DataEntity
{
    protected $id;
    protected $session_id;
    protected $product_id;

    protected $flags = [
        'id' => false,
        'session_id' => false,
        'product_id' => false,
    ];

    public function __construct($id = null, $session_id = null, $product_id = null)
    {
        $this->id = $id;
        $this->session_id = $session_id;
        $this->product_id = $product_id;
    }


}