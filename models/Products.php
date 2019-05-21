<?php

namespace app\models;

class Products extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $imgPath;
    public $dateCreate;
    public $dateChange;
    public $isActive;
    public $categoryId;

    public function __construct($name, $description, $price, $categoryId)
    {
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categoryId = $categoryId;
    }

    public function getTableName()
    {
        return 'products';
    }




}