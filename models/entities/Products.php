<?php

namespace app\models\entities;


class Products extends DataEntity
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $imgPath;
    protected $dateCreate;
    protected $dateChange;
    protected $isActive;
    protected $categoryId;

    protected $flags = [
        'id' => false,
        'name' => false,
        'description' => false,
        'price' => false,
        'imgPath' => false,
        'dateCreate' => false,
        'dateChange' => false,
        'isActive' => false,
        'categoryId' => false,
    ];

    public function __construct($name = null, $description = null, $price = null, $categoryId = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categoryId = $categoryId;
    }

}