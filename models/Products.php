<?php

namespace app\models;

class Products extends DbModel
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
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categoryId = $categoryId;
    }

    public static function getTableName()
    {
        return 'products';
    }

//    public function __set($field, $value) //TODO вынести в родителя
//    {
//        $this->$field = $value;
//        $this->flags["{$field}"] = true;
//    }

    public function getProps() {
        return $arrProps = [
                    "id" => $this->id,
                    "name" => $this->name,
                    'description' => $this->description,
                    'price' => $this->price,
                    'imgPath' => $this->imgPath,
                    'dateCreate' => $this->dateCreate,
                    'dateChange' => $this->dateChange,
                    'isActive' => $this->isActive,
                    'categoryId' => $this->categoryId,
                ];
    }

//    public function getFlags()  { //TODO вынести в родителя
//        return $this->flags;
//    }

}