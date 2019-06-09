<?php


namespace app\models\entities;

use app\models\Model;


abstract class DataEntity extends Model
{
    public function __set($field, $value)
    {
        $this->$field = $value;
        $this->flags["{$field}"] = true;
    }

    public function getFlags()
    {
        return $this->flags;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}