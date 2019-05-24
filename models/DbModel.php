<?php

namespace app\models;
use app\interfaces\IModel;
use app\engine\Db;


abstract class DbModel extends Model implements IModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    protected function insert() {
//        $arr = json_decode(json_encode($this), true);
        $props = $this->getProps();

        $tableName = static::getTableName();

        $queryParams = [];
        $queryColumns = [];

        foreach ($props as $key => $val) {

            if (is_null($val)) {
                continue;
            } else {
                $queryParams[":{$key}"] = $val;
                $queryColumns[] = "`$key`";
            }
        }

        $queryColumns = implode(", ", $queryColumns);
        $queryValues = implode(", ", array_keys($queryParams));

        $sql = "INSERT INTO `{$tableName}`({$queryColumns}) VALUES ($queryValues)";

        Db::getInstance()->exec($sql, $queryParams);

        $this->id = Db::getInstance()->lastInsertId();
    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";

        Db::getInstance()->exec($sql, ["id" => $this->id]);
    }

    protected function update() {
        //UPDATE `products` SET somethingChangeble = value WHERE id=$id;
        $props = $this->getProps();
        $tableName = static::getTableName();
        $flags = $this->getFlags();
        $column = '';

        foreach ($flags as $key => $val) {
            if ($val) {
                $column = $key;
            }
        }
//TODO поковырять конкатенацией, чтобы строилась строка, если во флагах более одного тру
        $value = $props["{$column}"];
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');

        $sql = "UPDATE `{$tableName}` SET `{$column}`= {$value}, dateChange = :dateChange WHERE id = :id";

        Db::getInstance()->exec($sql, ["id" => $this->id, "dateChange" => $date]);
    }

    public function save()
    {

        $flags = $this->getFlags();

        in_array(true, $flags, true) ? $this->update() : $this->insert();

    }

    public function __set($field, $value)
    {
        $this->$field = $value;
        $this->flags["{$field}"] = true;
    }

    public function getFlags()
    {
        return $this->flags; //TODO придумать проверку на наличие св-ва
    }

    public function __get($name)
    {
        return $this->$name;
    }

    abstract public static function getTableName();
    abstract public function getProps();

}