<?php


namespace app\models;


class Categories extends Model
{
    public $id;
    public $name;
    public $parentId;

    public function getTableName()
    {
        return 'categories';
    }
}